<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FarmingItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'label'      => fake()->word(),
            'image'      => null,
            'alt_text'   => fake()->sentence(),
            'sort_order' => fake()->numberBetween(0, 100),
            'is_visible' => true,
        ];
    }
}
