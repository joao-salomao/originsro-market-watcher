<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Alert;
use App\Model\Item;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Alert::class, function (Faker $faker) {
    return [
        'item_id' => Item::inRandomOrder()->first()->id,
        'max_price' => $faker->randomFloat()
    ];
});
