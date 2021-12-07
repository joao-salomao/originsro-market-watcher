<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::middleware('auth:api')->group(function () {
    Route::get('users/current', function () {
        return response(auth()->user());
    });

    Route::get('items', 'ItemController@index');
    Route::resource('alerts', AlertController::class);
});

Route::get('routes', [
    'uses' => function () {
        Artisan::call('route:list');
        return Artisan::output();
    }
]);
