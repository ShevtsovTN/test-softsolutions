<?php

namespace Database\Factories;

use App\Models\ModelCar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ModelCar>
 */
class ModelCarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Premium model', 'Advanced model', 'Simple model'])
        ];
    }
}
