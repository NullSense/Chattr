<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    // generate messages for 5 users
    $user_id = rand(0, 5);
    do {
        $to = rand(0, 5);
    } while ($user_id == $to);

    return [
        'user_id' => $user_id,
        'to' => $to,
        'body' => $faker->sentence,
    ];
});
