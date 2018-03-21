<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->words(rand(4, 8), true),
        'description' => $faker->text(80)
    ];
});
