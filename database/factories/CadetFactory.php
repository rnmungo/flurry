<?php

use Faker\Generator as Faker;

$factory->define(Flurry\Cadet::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
