# What was wrong, and what changed

Everything below was verified by reading the actual code in this repo, not
guessed at. File paths refer to the original repo.

## Security

- **`.env` was committed to git** with a real, working `APP_KEY` and a
  live production URL (`APP_URL=https://hamzabinzafar.infinityfree.me`, set
  in the "env update to production" commit). The root `.gitignore` had
  `# .env` — the exclusion was commented out, which is how the file ended
  up tracked in the first place. Fixed: uncommented the `.env` rule,
  untracked the file (`git rm --cached .env`, working copy kept locally),
  and shipped a freshly generated `APP_KEY` with `APP_URL` reset to
  `http://localhost`.

  The old production key is still present in this repo's git history and
  must be treated as permanently compromised — it is public — along with
  anything encrypted or signed with it. Before re-publishing this repo:
  rotate the key again on your own machine, and scrub the old `.env` from
  history (e.g. with `git filter-repo`) so the public log no longer
  contains it.
- **"Admin" was a hardcoded email string**, not a role:
  `dashboard.blade.php` had `@if (Auth::user()->email === 'admin@admin.com')`.
  No `role` column existed on `users`, no policy, no middleware. Fixed:
  added a real `role` column (migration), `User::isAdmin()`, an
  `EnsureUserIsAdmin` middleware, and an `admin` route group.
- **`database/database.sqlite` was committed** with ~100 fake pre-seeded
  users and votes baked in. Untracked (`git rm --cached`); it's now
  covered by both the root `.gitignore` (`/database/*.sqlite`) and
  `database/.gitignore` (`*.sqlite*`), so it stays out from here on.

## Broken functionality

- **`/vote` was a 500 error for every visitor.** The route did
  `return view('vote')`, but no `resources/views/vote.blade.php` existed
  anywhere in the project. The real voting UI
  (`resources/views/livewire/vote.blade.php`) was only reachable because it
  had been embedded directly inside `dashboard.blade.php`, and only for
  non-admin users, via a duplicate hand-rolled `<html>` document loading
  Tailwind from a CDN. Fixed: `/vote` now correctly routes to the
  `App\Livewire\Vote` component (this route existed in the file, commented
  out); `dashboard.blade.php` is now a normal page that links to `/vote`.
- **`database/seeders/UserSeeder.php` was missing its `namespace` and
  `use Illuminate\Database\Seeder` entirely** — running it would throw a
  fatal "class not found" error. It also was never called from
  `DatabaseSeeder`. Fixed and wired in; it now creates one admin and two
  test voters.
- **`database/seeders/CandidateSeeder.php` was a completely empty file.**
  Fixed: seeds three sample candidates.
- **Candidate images could never load.** The view read
  `asset('storage/' . $candidate->image)`, which requires
  `php artisan storage:link` — nothing in the repo ran or documented that
  step, and `public/storage` did not exist. Fixed: documented the required
  step, and views now fall back to an initials avatar when a candidate has
  no photo instead of a broken `<img>`.
- **The public landing page had no way to log in or register.**
  `welcome.blade.php` was just `@livewire('rankings')` inside a bare HTML
  document with no navigation at all. Fixed: added a header with
  login/register (or "Dashboard" if already signed in).
- `livewire/vote.blade.php` referenced `$candidate->party`, a field that
  never existed on the `candidates` table or model — it always rendered
  blank. Removed.

## Data integrity

- **Double-vote race condition.** `Vote.php` did
  `if (! Vote::where(...)->exists()) { Vote::create(...) }` with no
  transaction or lock. The `votes` table does have a unique constraint on
  `voter_id` (good), but the app never caught the resulting
  `QueryException`, so two near-simultaneous requests (double-click, two
  open tabs) would show the user a raw 500 error instead of a "you already
  voted" message. Fixed: the create is now wrapped in a transaction, and
  the exception is caught and turned into a normal flash message.
- **No validation that `selectedCandidate` was a real candidate ID.**
  Fixed: added `required|integer|exists:candidates,id` validation.
- **A candidate could be deleted after already receiving votes**, silently
  corrupting the results/turnout numbers. Fixed: deletion is blocked with
  a clear message if the candidate has any votes.
- **No way to close voting.** Added a `settings` table (`voting_open`
  flag) and an admin toggle; the vote form and `Vote::castVote()` both
  respect it.

## New: a real admin panel

There wasn't one — only a seeder could add candidates, and the
"dashboard" admin branch only had `@if (email === 'admin@admin.com')`
with no actual management UI, just the same voting form rendered again.
Added under `/admin` (gated by the `admin` middleware):

- **Overview** — turnout stats, open/close voting toggle.
- **Candidates** — add / edit / delete, with photo upload.

## Left as-is, worth knowing about

- Anyone can self-register and vote once verified — there's no invite-only
  voter roll or identity check. Fine for informal polls, not for anything
  where ballot-stuffing via disposable emails is a real risk.
- Live results are public on the homepage even while voting is open (this
  matches the app's original design intent). If you'd rather hide results
  until voting closes, that's a small, easy follow-up change.
