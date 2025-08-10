<?php

namespace App\Livewire\Admin;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vote;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Overview extends Component
{
    public bool $votingOpen;

    public function mount(): void
    {
        $this->votingOpen = Setting::isVotingOpen();
    }

    public function toggleVoting(): void
    {
        $setting = Setting::current();
        $setting->voting_open = ! $setting->voting_open;
        $setting->save();

        $this->votingOpen = $setting->voting_open;

        session()->flash('success', $this->votingOpen ? 'Voting is now open.' : 'Voting is now closed.');
    }

    public function render()
    {
        return view('livewire.admin.overview', [
            'totalVoters' => User::where('role', 'voter')->count(),
            'totalVotes' => Vote::count(),
            'totalCandidates' => Candidate::count(),
        ]);
    }
}
