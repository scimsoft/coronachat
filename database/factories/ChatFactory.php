<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Chat;
use Faker\Generator as Faker;
use Ramsey\Uuid\Type\Integer;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        //

        'messagetype' => $faker->randomDigit,
        'messagetext' => $faker->text(200),
        'likes' => $faker->randomDigit,
        'dislikes' => $faker->randomDigit,
    ];
});
