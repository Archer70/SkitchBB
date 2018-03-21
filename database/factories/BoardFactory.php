<?php

use Faker\Generator as Faker;

$factory->define(App\Board::class, function (Faker $faker) {
    return [
        'slug' => 'generic-board',
        'category_id' => 1,
        'title' => $faker->words(rand(4, 8), true),
        'description' => $faker->text(80)
    ];
});
