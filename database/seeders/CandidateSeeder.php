<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $candidates = [
            [
                'name' => 'Amara Chen',
                'details' => 'Focused on campus sustainability and budget transparency.',
            ],
            [
                'name' => 'Diego Ramirez',
                'details' => 'Advocating for expanded student services and club funding.',
            ],
            [
                'name' => 'Priya Nair',
                'details' => 'Running on accessibility improvements and mental health support.',
            ],
        ];

        foreach ($candidates as $candidate) {
            Candidate::updateOrCreate(['name' => $candidate['name']], $candidate);
        }
    }
}
