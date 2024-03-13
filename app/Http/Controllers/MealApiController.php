<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MealRequest;
use App\Http\Resources\MealCollection;
use Illuminate\Support\Facades\Config;

class MealApiController extends Controller
{

    //index function used by api get meals route
    public function index(MealRequest $request)
    {
        try {
            //get language from query
            $lang = $request->validated()['lang'];
            //set language based on "lang" query parameter e.g. "lang=en"
            app()->setLocale($lang);
            //get meals
            $meals = Meal::query();
            //check if request has diff_time
            if ($request->has('diff_time')) {
                //query with soft deleted if there is a diff_time paramter
                $meals->withTrashed();
            }
            //filter by category if query has "category" e.g. "category=1"
            if ($request->has('category')) {

                $category = $request->validated()['category'];

                //category can be null, !null and categoryId
                if (Str::lower($category) === 'null') {
                    $meals->whereNull('category');
                } 
                else if (Str::lower($category) === '!null') {
                    $meals->whereNotNull('category');
                } 
                else {
                    $meals->where('category', $category);
                }
            }
            //filter by tags e.g. "tags=1,2"
            if ($request->has('tags')) {

                $tags = explode(',', $request->validated()['tags']);

                //filter only those meals that have exacly those tags defined in the querry
                $meals->whereHas('tags', function ($q) use ($tags) {
                    $q->whereIn('id', $tags);
                }, '=', count($tags));
            }
            //optional data that a certain meal has category, tags and ingredients
            // e.g. with=ingredients,tags,category
            if ($request->has('with')) {

                $properties = explode(',', $request->validated()['with']);
                $meals->with($properties);
            }
            //paginate results based on user input e.g. ?per_page=10
            $perPage = $request->validated()['per_page'] ?? 10;       
            //return meal colection with all requested data
            return new MealCollection($meals->paginate($perPage));
        } catch (\Exception $e) {
            //in case of an error show it instead of sending data
            return response($e->getMessage());
        };
    }
}
