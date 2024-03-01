<?php

use App\Http\Controllers\MealApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Api get route for meals
//e.g. .../api/meals?lang=en&with=ingredients,tags,category
Route::get('/meals',[MealApiController::class, 'index']);
