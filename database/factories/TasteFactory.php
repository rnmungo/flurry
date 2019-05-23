<?php

use Faker\Generator as Faker;

$factory->define(Flurry\Taste::class, function (Faker $faker) {
    return [
    	'name' => $faker->sentence(2),
    	'description' => $faker->sentence(5, false),
    	'color' => strtoupper(substr($faker->hexColor, 1)),
    	'white_text' => $faker->boolean(),
    ];
});
