<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Language;
use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //create data in database.sqlite manually
        Language::create([
            'locale' => 'en',
            'name' => 'English',
        ]);

        Language::create([
            'locale' => 'hr',
            'name' => 'Hrvatski',
        ]);

        Category::create([
            'slug' => 'category-1',
            'en' => ['title' => 'Category in ENG'],
            'hr' => ['title' => 'Kategorija na HRV'],
            
            
        ]);

        Ingredient::create([
            'slug' => 'ingredient-1',
            'en' => ['title' => 'Ingredinet in ENG'],
            'hr' => ['title' => 'Sastojak na HRV'],
        ]);

        Tag::create([
            'slug' => 'tag-1',
            'en' => ['title' => 'Tag in ENG'],
            'hr' => ['title' => 'tag na HRV'],
        ]);

        //create data in database using Faker/factory
        Category::factory(5)->create();
        Tag::factory(5)->create();
        Ingredient::factory(5)->create();
        Meal::factory(5)->create();

        $meal=Meal::create([
            'category'=>null,
            'en' => [
                'title' => 'Meal1 in ENG',
                'description' => 'This is a dish 1 in ENG'
            ],
            'hr' => [
                'title' => 'jelo 1 na HRV ',
                'description' => 'ovo je jelo 1 na hrv'
            ],
            'created_at' => '2024-02-29 09:37:03',
            'updated_at' => '2024-02-29 11:37:03',
            'deleted_at' => '2024-02-29 13:37:03'
        ]);
        $meal->ingredients()->attach(1);
        $meal->tags()->attach(1);  

        Meal::create([
            'category'=>Category::inRandomOrder()->first()->id,
            'en' => [
                'title' => 'Meal 2 in ENG',
                'description' => 'This is a dish 2 in ENG'
            ],
            'hr' => [
                'title' => 'jelo 2 na HRV ',
                'description' => 'ovo je jelo 2 na hrv'
            ],
        ]);

        // Get all meals, tags and ingredients
        $meals = Meal::all();
        $tags = Tag::all();
        $ingredient = Ingredient::all();

        //Loop through meals and attach random tags
        $meals->each(function ($meal) use ($tags) {
            $numberOfTags = rand(1, count($tags));
            $meal->tags()->attach($tags->random($numberOfTags)->pluck('id')->toArray());
        });

        //Loop through meals and attach random ingredients
        $meals->each(function ($meal) use ($ingredient) {
            $numberOfIngredients = rand(1, count($ingredient));
            $meal->ingredients()->attach($ingredient->random($numberOfIngredients)->pluck('id')->toArray());
        });
  
    }
}
