<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
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
        //define ingredient array with ingredient slug
        $ingredient = ['slug' => $this->faker->words(1, true) . '-ing-' . $this->count];

        //set ingredient title for each locale
        foreach ($locales as $locale) {

            $ingredient[$locale] = [
                'title' => $this->faker->words(2, true) . ' sastojak-' . $this->count . '-' . strtoupper($locale)
            ];
        }
        //return ingredient with slug and title for each locale
        return $ingredient;
    }
}
