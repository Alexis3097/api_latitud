<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CashRegister;
use Faker\Generator as Faker;
$factory->define(CashRegister::class, function (Faker $faker) {
    return [
        'box_id' => $faker->numberBetween(1,3),
        'last_amount' => $faker->numberBetween(100,8000),
        'account' => $faker->numberBetween(100,8000),
        'now_amount' =>$faker->numberBetween(100,8000),
    ];
});
