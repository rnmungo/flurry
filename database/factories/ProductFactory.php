<?php

use Faker\Generator as Faker;

$factory->define(Flurry\Product::class, function (Faker $faker) {
    return [
    	'name' => $faker->sentence(2),
    	'alias' => $faker->sentence(1),
    	'description' => $faker->sentence(6, false),
    	'hasTastes' => $faker->boolean(),
    	'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 1200),
    ];
});

$factory->afterMaking(Flurry\Product::class, function ($product, $faker) {
	if ($product->hasTastes){
	    $product->max_tastes = $faker->numberBetween(1, 5);
	    $product->weight = $faker->numberBetween(20, 5000);
	}
});

$factory->afterCreating(Flurry\Product::class, function ($product, $faker) {
    if ($product->hasTastes){
        $product->max_tastes = $faker->numberBetween(1, 5);
        $product->weight = $faker->numberBetween(20, 5000);
    }
});