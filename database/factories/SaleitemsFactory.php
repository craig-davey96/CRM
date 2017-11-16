<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\SalesItems::class, function (Faker $faker) {
    return [
        'sales_item_name' => $faker->name,
        'sales_item_description' => $faker->text,
        'sales_item_price' => $faker->numberBetween(1,100)
    ];
});
