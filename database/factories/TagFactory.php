<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
            'en' => ['title' =>'Tag ' .  $this->faker->words(1 ,true) . ' EN'],
            'hr' => ['title' =>'Tag ' .  $this->faker->words(1 ,true) . ' HR'],
        ];
    }
}
