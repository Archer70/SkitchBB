<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'topic_id' => 1,
        'user_id' => 1,
        'body' => $faker->paragraph(),
        'approved' => true,
    ];
});
