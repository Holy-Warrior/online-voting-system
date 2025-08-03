<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            // 'image' => 'images/candidates/' . $this->faker->unique()->word() . '.jpg',
            'image' => 'images/candidates/image.png',
            'details' => $this->faker->sentence(),
        ];
    }
}
