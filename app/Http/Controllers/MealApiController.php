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
        app()->setLocale($request->input('lang'));

        $meals = Meal::query()->withTrashed();

        if ($request->has('category')) {

            $category = $request->input('category');

            if ($category === 'null') {
                $meals->whereNull('category');
            } else {
                $meals->where('category', $category);
            }
        }

        if ($request->has('tags')) {

            $tags = explode(',', $request->input('tags'));

            $meals->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('id', $tags);
            }, '=', count($tags));
        }

        if ($request->has('with')) {

            $properties = explode(',', $request->input('with'));
            $meals->with($properties);
        }

        $perPage = $request->input('per_page', 10);
        return new MealCollection($meals->paginate($perPage));
    }
}
