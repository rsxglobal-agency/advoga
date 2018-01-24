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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $city = App\City::all()->random();


    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'description' => $faker->realText(),
        'social' => "http://linkedin.com/" . $faker->userName,
        'remember_token' => str_random(10),
        'state_id' => $city->state_id,
        'city_id' => $city->id,
        'active' => $faker->boolean(),
        'formation_id' => App\Formation::all()->random()->id,
        'titulation_id' => App\Titulation::all()->random()->id,

    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Demand::class, function (Faker\Generator $faker) {
    static $password;
    $city = App\City::all()->random();
    return [
        'name' => $faker->name,
        'description' => $faker->realText(),
        'user_id' => App\User::all()->random()->id,
        'ended' => $faker->boolean(),
        'state_id' => $city->state_id,
        'city_id' => $city->id,

    ];
});





