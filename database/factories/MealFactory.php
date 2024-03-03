<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meals>
 */
class MealFactory extends Factory
{
    protected $count = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->count++;
        //get locales from languages table
        $locales = Language::pluck('locale');
        //define meal array with meal slug
        $meal = [
            'category' => Category::inRandomOrder()->first()->id
        ];

        //set meal title and description for each locale
        foreach ($locales as $locale) {

            $meal[$locale] = [
                'title' => $this->faker->words(2, true) . ' meal-naslov-' . $this->count . '-' . strtoupper($locale),
                'description' => $this->faker->words(7, true) . ' meal-opis-' . $this->count . '-' . strtoupper($locale)
            ];
        }
        //return meal with category,title and description for each locale
        return $meal;
    }
}
