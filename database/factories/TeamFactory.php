<?php

use Faker\Generator as Faker;

$factory->define(\App\Team::class, function (Faker $faker) {
    $animals = [
        'Beavers',
        'Wildcats',
        'Badgers',
        'Bats',
        'Bulldogs',
        'Zebras',
        'Goldfish',
        'Pythons',
        'Falcons',
        'Crayfish',
        'Buffalos',
        'Yaks',
        'Crocodiles',
        'Panthers',
    ];

    return [
        'name' => "{$faker->city} {$faker->randomElement($animals)}",
    ];
});
