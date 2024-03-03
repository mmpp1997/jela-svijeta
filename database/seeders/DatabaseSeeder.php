<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\Meal;
use App\Models\Category;
use App\Models\Language;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //check config/translatable.php for supported languages
        $locales = Config::get('translatable.locales');
        //create languages in database.sqlite languages table
        foreach ($locales as $locale) {
            Language::create([
                'locale' => $locale,
                'name' => strtoupper($locale) . ' jezik',
            ]);
         }

        //create data in database using factory
        Category::factory(5)->create();
        Tag::factory(5)->create();
        Ingredient::factory(5)->create();
        Meal::factory(5)->create();

        //add one meal manually for diff_time query testing purposes
        $meal=Meal::create([
            'category'=>null,
            'en' => [
                'title' => 'Meal1 in ENG',
                'description' => 'This is a dish 1 in ENG'
            ],
            'hr' => [
                'title' => 'jelo 1 na HRV ',
                'description' => 'ovo je jelo 1 na HRV'
            ],
            'created_at' => '2024-02-29 09:37:03',
            'updated_at' => '2024-02-29 11:37:03',
            'deleted_at' => '2024-02-29 13:37:03'
        ]);
        $meal->ingredients()->attach(1);
        $meal->tags()->attach(1);  

        // Get all meals, tags and ingredients
        $meals = Meal::all();
        $tags = Tag::all();
        $ingredients = Ingredient::all();

        //Loop through meals and attach random number of tags
        $meals->each(function ($meal) use ($tags) {
            $numberOfTags = rand(1, count($tags));
            $meal->tags()->attach($tags->random($numberOfTags)->pluck('id')->toArray());
        });

        //Loop through meals and attach random number of ingredients
        $meals->each(function ($meal) use ($ingredients) {
            $numberOfIngredients = rand(1, count($ingredients));
            $meal->ingredients()->attach($ingredients->random($numberOfIngredients)->pluck('id')->toArray());
        });
  
    }
}
