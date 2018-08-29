<?php

use Faker\Generator as Faker;

/*$factory->define(App\Product::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'description' => $faker->paragraphs(10, true),
        'slug' => kebab_case($title),
        'user_id' => function () {
            return random_int(1, 2);
        }
    ];
});*/

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraphs(5, true),
        'user_id' => function () {
            return random_int(1, 2);
        }
    ];
});
