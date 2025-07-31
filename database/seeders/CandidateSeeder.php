<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/CandidateSeeder.php
    public function run(): void
    {
        Candidate::create(['name' => 'Alice Smith', 'party' => 'Unity Party']);
        Candidate::create(['name' => 'Bob Johnson', 'party' => 'Progressive Front']);
    }
}
