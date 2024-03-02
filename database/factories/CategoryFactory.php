<?php

namespace Database\Factories;

use App\Models\Language;
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
        //get locales from languages table
        $locales = Language::pluck('locale');
        //define category array with category slug
        $category=['slug' => $this->faker->words(1 ,true) . '-' . $this->faker->randomDigit()];

        $word=$this->faker->words(2 ,true);
        //set category name for each locale
        foreach ($locales as $locale) {
            
            $category[$locale] = [
                'title' => $word . ' ' . strtoupper($locale)
            ];
         }
        //return category with slug and title for each locale
        return $category;
    }
}