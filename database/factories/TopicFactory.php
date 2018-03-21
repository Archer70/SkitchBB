<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'slug' => 'first_thread',
        'board_id' => 1,
        'first_post_id' => 1,
        'last_post_id' => 1,
        'user_id' => 1,
        'title' => $faker->words(rand(4, 8), true),
        'sticky' => false,
        'locked' => false,
        'post_count' => 1
    ];
});
