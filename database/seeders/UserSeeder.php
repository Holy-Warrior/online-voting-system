<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * NOTE: change these default passwords immediately in any environment
     * other than local development.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Election Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'voter1@example.com'],
            [
                'name' => 'Test Voter One',
                'password' => Hash::make('password'),
                'role' => 'voter',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'voter2@example.com'],
            [
                'name' => 'Test Voter Two',
                'password' => Hash::make('password'),
                'role' => 'voter',
                'email_verified_at' => now(),
            ]
        );
    }
}
