<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'id'=> 1,
    ];
});

$factory->define(App\Note::class, function (Faker\Generator $faker) {

    $starts_at = Carbon::createFromTimestamp($faker->dateTimeBetween($startDate = '+2 days', $endDate = '+1 week')->getTimeStamp()) ;
    
    return [
        'title' => $faker->title,
        'body' => $faker->paragraph,
        'user_id' => 1,
        'created_at' => $starts_at,
    ];
});

