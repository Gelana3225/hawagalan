<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeaderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => fake()->name(),
            'title'       => fake()->jobTitle(),
            'photo'       => null,
            'description' => fake()->paragraph(),
            'sort_order'  => fake()->numberBetween(0, 100),
            'is_visible'  => true,
        ];
    }
}
