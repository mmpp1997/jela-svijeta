<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealCollection;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealApiController extends Controller
{

    //index function used by api get meals route
    public function index(Request $request)
    {
        try {
            //check for lang parameter
            if (!$request->has('lang')) {
                throw new \Exception('Language parameter "lang" is missing.');
            }
            //set language based on "lang" query parameter e.g. "lang=en"
            app()->setLocale($request->input('lang'));

            //get meals with soft deleted
            $meals = Meal::query()->withTrashed();

            //filter by category if query has "category" e.g. "category=1"
            if ($request->has('category')) {

                $category = $request->input('category');

                //per task request category can be null or !null
                if ($category === 'null') {
                    $meals->whereNull('category');
                } else {
                    $meals->where('category', $category);
                }
            }

            //filter by tags if query has "tags" e.g. "tags=1,2"
            if ($request->has('tags')) {

                $tags = explode(',', $request->input('tags'));

                //filter only those meals that have exacly those tags defined in the querry
                $meals->whereHas('tags', function ($q) use ($tags) {
                    $q->whereIn('id', $tags);
                }, '=', count($tags));
            }

            //optional data that a certain meal has category, tags and ingredients
            // e.g. with=ingredients,tags,category
            if ($request->has('with')) {

                $properties = explode(',', $request->input('with'));
                $meals->with($properties);
            }

            //paginate results based on user input e.g. ?per_page=10&page=2
            $perPage = $request->input('per_page', 10);

            //return meal colection with all requested data
            return new MealCollection($meals->paginate($perPage));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid query'], 500)->getContent();
        };
    }
}
