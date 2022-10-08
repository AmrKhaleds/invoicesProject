<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\factories>
 */
class FactoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'factory_name' => fake()->sentence('1'),
            'description' => fake()->sentence('8'),
            'created_by' => 'Amr Khaled',
        ];
    }
}
