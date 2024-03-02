<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meals>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //fill meal data 
        return [
            'category' => Category::inRandomOrder()->first()->id,
            'en' => [
                'title' => 'Food ' . $this->faker->words(2, true) . ' EN',
                'description' => $this->faker->sentences(1, true) . ' EN'
            ],
            'hr' => [
                'title' => 'Jelo ' . $this->faker->words(2, true) . ' HR',
                'description' => $this->faker->sentences(1, true) . ' HR'
            ],



        ];
    }
}
