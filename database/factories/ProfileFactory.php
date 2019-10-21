<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'image' => 'https://lorempixel.com/640/480/',
        'screen_name' => $faker->sentence,
        'content' => $faker->sentence,
        'description' => $faker->paragraph,
        'user_name' => $faker->sentence,
        'date' => $faker->date($format = 'Y-m-d')
    ];
});