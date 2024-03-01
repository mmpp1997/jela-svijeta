<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //fill category data 
        return [
            'slug' => $this->faker->words(1 ,true) . '-' . $this->faker->randomDigit(),
            'en' => ['title' =>'Category ' .  $this->faker->words(1 ,true) . ' EN'],
            'hr' => ['title' =>'Kategorija ' .  $this->faker->words(1 ,true) . ' HR'],
        ];
    }
}
