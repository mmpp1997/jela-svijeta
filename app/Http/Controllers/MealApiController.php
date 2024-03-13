<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MealCollection;
use Illuminate\Support\Facades\Config;

class MealApiController extends Controller
{

    //index function used by api get meals route
    public function index(Request $request)
    {
        try {
            //check for lang parameter
            if (!$request->has('lang')) {
                throw new \Exception('missing lang parameter');
            }
            //get supported languages
            $locales = Config::get('translatable.locales');
            //get language from query
            $lang = $request->input('lang');
            //check if language is supported
            if (!in_array($lang, $locales)) {
                //if not send error
                throw new \Exception('unsupported language check config/translatable.php');
            } else {
                //set language based on "lang" query parameter e.g. "lang=en"
                app()->setLocale($lang);
            }
            //get meals
            $meals = Meal::query();
            //check if request has diff_time
            if ($request->has('diff_time')) {

                //check if diff time was inputted correctly
                if ($request->input('diff_time') <= 0) {
                    throw new \Exception('invalid input for diff_time');
                }
                //query with soft deleted if there is  a diff_time paramter
                $meals->withTrashed();
            }
            
            //filter by category if query has "category" e.g. "category=1"
            if ($request->has('category')) {

                $category = $request->input('category');

                //per task request category can be null, !null and categoryId
                if (Str::lower($category) === 'null') {
                    $meals->whereNull('category');
                }
                else if(Str::lower($category) === '!null'){
                    $meals->whereNotNull('category');
                }
                 else {
                    $meals->where('category', $category);
                }
            }
            //filter by tags e.g. "tags=1,2"
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
            //paginate results based on user input e.g. ?per_page=10
            $perPage = $request->input('per_page', 10);
            //check if per_page is valid
            if (!is_numeric($perPage) || $perPage <= 0) {
                throw new \Exception('invalid input for per_page query parametner');
            }
            //select page based on user input e.g. ?page=1
            $page = $request->input('page', 1);
            //check if per_page is valid
            if (!is_numeric($page) || $page <= 0) {
                throw new \Exception('invalid input for page query parametner');
            }
            //return meal colection with all requested data
            return new MealCollection($meals->paginate($perPage));
        } catch (\Exception $e) {
            //in case of an error show it instead of sending data
            return response($e->getMessage());
        };
    }
}
