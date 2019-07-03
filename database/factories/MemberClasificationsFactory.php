<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\MemberClasification;
use Faker\Generator as Faker;

$factory->define(MemberClasification::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
    ];

});
