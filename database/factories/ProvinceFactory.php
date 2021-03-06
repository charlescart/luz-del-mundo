<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Province;
use Faker\Generator as Faker;

$factory->define(Province::class, function (Faker $faker) {
    return [
        'country_id' => 1,
        'name' => $faker->name,
    ];
});
