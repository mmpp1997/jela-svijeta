<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
        //define tag array with tag slug
        $tag = ['slug' => $this->faker->words(1, true) . '-tag-' . $this->count];

        //set tag title for each locale
        foreach ($locales as $locale) {

            $tag[$locale] = [
                'title' => $this->faker->words(2, true) . ' tag-' . $this->count . '-' . strtoupper($locale)
            ];
        }
        //return tag with slug and title for each locale
        return $tag;
    }
}