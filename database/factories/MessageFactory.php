<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    // generate messages for 5 users (arbitrary)
    $user_id = $faker->numberBetween(0, User::count());
    do {
        $to = $faker->numberBetween(0, User::count());
    } while ($user_id == $to);

    return [
        'user_id' => $user_id,
        'to' => $to,
        'body' => $faker->sentence,
    ];
});
