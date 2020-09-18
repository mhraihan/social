<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 11),
        'body' => $faker->sentence(),
        'created_at' => Carbon::now()->subMinutes(rand(10, 100))
    ];
});
