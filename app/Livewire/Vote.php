<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\Vote as VoteModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Vote extends Component
{
    public ?int $selectedCandidate = null;

    public bool $hasVoted = false;

    public function mount(): void
    {
        $this->hasVoted = VoteModel::where('voter_id', Auth::id())->exists();
    }

    public function castVote(): void
    {
        $voter = Auth::user();

        if (! Setting::isVotingOpen()) {
            session()->flash('error', 'Voting is currently closed.');

            return;
        }

        // Check up front so a returning voter gets a clean message
        // instead of a validation error.
        if ($this->hasVoted || VoteModel::where('voter_id', $voter->id)->exists()) {
            $this->hasVoted = true;
            session()->flash('error', 'You have already voted.');

            return;
        }

        $this->validate([
            'selectedCandidate' => ['required', 'integer', 'exists:candidates,id'],
        ], [
            'selectedCandidate.required' => 'Please choose a candidate before submitting.',
        ]);

        try {
            DB::transaction(function () use ($voter) {
                VoteModel::create([
                    'voter_id' => $voter->id,
                    'candidate_id' => $this->selectedCandidate,
                ]);
            });
        } catch (QueryException $e) {
            // The votes table has a unique constraint on voter_id, so if two
            // requests both slip past the exists() check above at the same
            // time (double-click, double tab, etc.), the second insert is
            // rejected here instead of silently recording a second vote.
            $this->hasVoted = true;
            session()->flash('error', 'You have already voted.');

            return;
        }

        $this->hasVoted = true;
        session()->flash('success', 'Your vote has been cast successfully.');
    }

    public function render()
    {
        return view('livewire.vote', [
            'candidates' => Candidate::orderBy('name')->get(),
            'votingOpen' => Setting::isVotingOpen(),
        ]);
    }
}
