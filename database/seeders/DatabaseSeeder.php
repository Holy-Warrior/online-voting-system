<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            UserSeeder::class,
            CandidateSeeder::class,
        ]);

        // Want a big pile of fake demo data (100 users who've already
        // voted) instead? Run it separately:
        //   php artisan db:seed --class=VotingSeeder
    }
}
