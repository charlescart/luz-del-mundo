<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'province_id' => 1,
        'name' => $faker->name,
    ];
});
