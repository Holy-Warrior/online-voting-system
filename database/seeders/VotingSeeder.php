<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;

class VotingSeeder extends Seeder
{
    public function run(): void
    {
        // Create 7 candidates
        $candidates = Candidate::factory()->count(7)->create();

        // Create 100 users
        $users = User::factory()->count(100)->create();

        // Each user casts a vote for a random candidate
        foreach ($users as $user) {
            Vote::create([
                'voter_id' => $user->id,
                'candidate_id' => $candidates->random()->id,
            ]);
        }
    }
}
