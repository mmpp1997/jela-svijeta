<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealCollection;
use App\Http\Resources\MealResource;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealApiController extends Controller
{
    public function index()
    {
        return new MealCollection(Meal::with(['category','tags','ingredients'])->get());
        //$meals = Meal::with('categories')->get();

        // Return the users as a resource collection
        //return MealResource::collection($meals);
    }
}
