<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function() {
    Route::get('users/{user}/animals', 'API\UserController@animals');
    Route::apiResource('users', 'API\UserController');

    Route::apiResource('animals', 'API\AnimalController');
    Route::apiResource('animals_types', 'API\AnimalTypeController');
    Route::apiResource('animals_breeds', 'API\AnimalBreedController');
});