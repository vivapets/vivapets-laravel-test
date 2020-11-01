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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::group(['prefix' => 'animals'], function() {
        Route::get('/', 'AnimalsController@index')->name('api.animals');
        Route::get('/{animal}', 'AnimalsController@show')->name('api.animals.show');
        Route::post('/', 'AnimalsController@store')->name('api.animals.store');
        Route::put('/{animal}', 'AnimalsController@update')->name('api.animals.update');
        Route::delete('/{animal}', 'AnimalsController@delete')->name('api.animals.delete');
    });
});