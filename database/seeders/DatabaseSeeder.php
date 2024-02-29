<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Ingredient;
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
        // Category::factory(5)->create();
        // Tag::factory(5)->create();
        // Ingredient::factory(5)->create();
        // Meal::factory(5)->create();


        // // Get all meals and tags
        // $meals = Meal::all();
        // $tags = Tag::all();
        // $ingredient = Ingredient::all();

        // // Loop through meals and attach random tags
        // $meals->each(function ($meal) use ($tags) {
        //     $numberOfTags = rand(1, 3);
        //     $meal->tags()->attach($tags->random($numberOfTags)->pluck('id')->toArray());
        // });

        // // Loop through meals and attach random ingredients
        // $meals->each(function ($meal) use ($ingredient) {
        //     $numberOfIngredients = rand(1, 3);
        //     $meal->ingredients()->attach($ingredient->random($numberOfIngredients)->pluck('id')->toArray());
        // });

        // Meal::factory()->create([
        //     'title' => 'Test Meal',
        //     'description' => 'meal without category',
        //     'category'=>null
        // ]);
        // Meal::factory()->create([
        //     'title' => 'izbrisano jelo',
        //     'description' => 'izbrisani opis jela',
        //     'category'=>null,
        //     'created_at' => '2024-02-29 09:37:03',
        //     'updated_at' => '2024-02-29 11:37:03',
        //     'deleted_at' => '2024-02-29 13:37:03'
        // ]);

        // $product = new Category();
        // $product->slug="kategorija-1";

        // $product->setAttribute('en', 'title', 'category in EN');
        // $product->save();
        Category::create([
            'slug' => 'category-1',
            'en' => ['title' => 'Category in ENG'],
            'fr' => ['title' => 'Kategorija na HRv'],
        ]);

        Ingredient::create([
            'slug' => 'ingredient-1',
            'en' => ['title' => 'Ingredinet in ENG'],
            'fr' => ['title' => 'Sastojak na HRv'],
        ]);

        Tag::create([
            'slug' => 'tag-1',
            'en' => ['title' => 'Tag in ENG'],
            'fr' => ['title' => 'tag na HRv'],
        ]);

        $meal = Meal::create([
            'category' => 1,
            'en' => [
                'title' => 'Meal in ENG',
                'description' => 'This is a dish in ENG'
            ],
            'fr' => [
                'title' => 'jelo na HRv',
                'description' => 'ovo je jelo na hrv'
            ]
        ]);
        $meal->ingredients()->attach(1);
        $meal->tags()->attach(1);
    }
}
