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
    public function index(Request $request)
    {
        //return new MealCollection(Meal::with(['category','tags','ingredients'])->get());
        $query = Meal::query();

        if ($request->has('with')) {

            $properties = explode(',', $request->input('with'));
            $query->with($properties);
        }

        $perPage = $request->input('per_page');
        return new MealCollection($query->paginate($perPage));
    }
}
