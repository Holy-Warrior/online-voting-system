<?php

namespace App\Livewire;

use App\Models\Candidate;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Rankings extends Component
{
    public function render()
    {
        $candidates = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->orderBy('name')
            ->get();

        return view('livewire.rankings', [
            'topThree' => $candidates->take(3)->values(),
            'others' => $candidates->slice(3)->values(),
            'totalVotes' => $candidates->sum('votes_count'),
        ]);
    }
}
