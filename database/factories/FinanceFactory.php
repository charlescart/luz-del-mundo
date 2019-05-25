<?php

use Faker\Generator as Faker;

$factory->define(App\Finance::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return random_int(1, 7); // hay 7 users
        },
        'finance_classification_id' => function(){
            return random_int(1, 3);
        },
        'currency_id' => function(){
            return random_int(1, 2);
        },
        'debit_to' => function(){
            return random_int(1, 2);
        },
        'amount' => function() {
            return rand(10, 100);
        },
        'debt' => function() {
            return rand(0, 10);
        },
        'description' => $faker->paragraph,
        'tithe' => $faker->boolean
    ];
});
