<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/login', function () {
//     return Socialite::driver('discord')->redirect();
// });

// Route::get('/login/callback', function () {
//     return Socialite::driver('discord')->stateless()->user()->getRaw();
// });

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
