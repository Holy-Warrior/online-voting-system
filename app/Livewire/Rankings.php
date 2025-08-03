<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidate;

class Rankings extends Component
{
    public function render()
    {
        $candidates = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        $topThree = $candidates->take(3);
        $others = $candidates->slice(3);

        return view('livewire.rankings', [
            'topThree' => $topThree,
            'others' => $others,
        ]);
    }
}
