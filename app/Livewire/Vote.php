<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\Vote as VoteModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Vote extends Component
{
    public $selectedCandidate;

    public function castVote()
    {
        $voter = Auth::user();

        if (VoteModel::where('voter_id', $voter->id)->exists()) {
            session()->flash('error', 'You have already voted.');
            return;
        }

        VoteModel::create([
            'voter_id' => $voter->id,
            'candidate_id' => $this->selectedCandidate,
        ]);

        session()->flash('success', 'Vote cast successfully.');
    }

    public function render()
    {
        return view('livewire.vote', [
            'candidates' => Candidate::all()
        ]);
    }
}
