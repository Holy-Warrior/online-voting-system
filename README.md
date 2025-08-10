# Online Voting System

A simple election app built on Laravel 12 + Livewire/Volt (the official
`laravel/livewire-starter-kit`, with Flux UI for components).

Anyone can register and cast **one vote** for a candidate. An admin account
can manage candidates and open/close voting. Results are visible live on
the homepage.

> This repo was audited and repaired — see [CHANGES.md](./CHANGES.md) for
> the full list of what was broken and what changed.

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm

## Setup

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate --seed

# Required so uploaded candidate photos are reachable at /storage/...
php artisan storage:link

npm run build   # or `npm run dev` while developing
php artisan serve
```

The default seeders (`php artisan db:seed`, or `--seed` above) create:

| Account | Email | Password | Role |
|---|---|---|---|
| Admin | `admin@example.com` | `password` | admin |
| Voter | `voter1@example.com` | `password` | voter |
| Voter | `voter2@example.com` | `password` | voter |

Also seeded: 3 sample candidates, and a settings row with voting open.

**Change these passwords before deploying anywhere real.**

Want a big pile of fake demo data instead (100 random users who've each
already voted)? Run it separately — it's not part of the default seed:

```bash
php artisan db:seed --class=VotingSeeder
```

## How it works

- `/` — public landing page with live results, and login/register links.
- `/vote` — the ballot. Requires a verified, logged-in account. One vote
  per account, enforced both in the app and by a unique database
  constraint (so it holds even under a race condition, e.g. a double-click
  or two tabs submitting at once).
- `/results` — the same live results shown on the homepage.
- `/admin` — candidate management (add/edit/delete, photo upload) and a
  toggle to open/close voting. Restricted to accounts with `role = admin`
  via the `admin` middleware.

Roles live on `users.role` (`voter` or `admin`). New self-registrations
always come in as `voter`; there is currently no self-serve way to become
admin — promote someone with:

```bash
php artisan tinker
>>> App\Models\User::where('email', 'someone@example.com')->update(['role' => 'admin']);
```

## Candidate photos

Uploaded through the admin panel, they're stored on the `public` disk
under `storage/app/public/candidates/` and served via the `public/storage`
symlink created by `php artisan storage:link`. Candidates without a photo
show an initials avatar instead — nothing breaks if you skip uploading
one.

## Security notes

- The version of this repo pulled from GitHub had a real `.env` (including
  a working `APP_KEY`) committed to git history. Treat that key, and
  anything encrypted or signed with it, as permanently compromised — it's
  public. This copy ships a freshly generated key, but if you're pushing
  this repo anywhere, rotate the key again yourself and consider scrubbing
  git history (e.g. with `git filter-repo`) before making the repo public
  again.
- `.env` and `database/*.sqlite` are now actually excluded via
  `.gitignore` — previously `.env` exclusion was commented out, which is
  how it ended up committed in the first place.
- This is a simple one-account-one-vote system suitable for informal
  polls (class elections, club votes, etc.). It has no protection against
  someone registering multiple email addresses to vote more than once —
  that would require an invite-only voter roll or a real identity check,
  which is out of scope here but worth knowing before using this for
  anything with real stakes.

## Tech stack

Laravel 12, Livewire 3 + Volt, Flux UI, Tailwind CSS v4 (via Vite), SQLite
by default (swap `DB_CONNECTION` in `.env` for MySQL/Postgres in
production).
