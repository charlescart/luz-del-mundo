<?php

use Faker\Generator as Faker;

$factory->define(App\FinanceClassification::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'description' => $faker->paragraph,
        'color' => $faker->hexColor,
        'class' => $faker->firstNameMale,
    ];
});
