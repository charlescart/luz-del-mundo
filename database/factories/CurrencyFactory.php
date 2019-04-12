<?php

use Faker\Generator as Faker;

$factory->define(App\Currency::class, function (Faker $faker) {
    return [
        'code' => $faker->currencyCode,
        'description' => $faker->paragraph
    ];
});
