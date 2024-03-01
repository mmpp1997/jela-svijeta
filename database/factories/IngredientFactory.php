<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->words(1 ,true) . '-' . $this->faker->randomDigit(),
            'en' => ['title' =>'Ingredient ' .  $this->faker->words(1 ,true) . ' EN'],
            'hr' => ['title' =>'Sastojak ' .  $this->faker->words(1 ,true) . ' HR'],
        ];
    }
}
