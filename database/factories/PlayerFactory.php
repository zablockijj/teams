<?php

use Faker\Generator as Faker;

$factory->define(\App\Player::class, function (Faker $faker) {
    return [
        'team_id'    => factory(\App\Team::class)->make()->id,
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
    ];
});
