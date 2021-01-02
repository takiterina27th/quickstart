<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->realText(50),
        'content' => $faker->realText(200),
        'user_id' => $faker->randomElement(['1', '2']),
    ];
});
