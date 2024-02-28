<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealsCollection;
use App\Http\Resources\MealsResource;
use App\Models\Meals;
use Illuminate\Http\Request;

class MealsApiController extends Controller
{
    public function index()
    {
        return new MealsCollection(Meals::all());
    }
}
