<?php

// use Flurry\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
	$isDepartment = $faker->boolean(30);
    
    return [
    	'name' => $faker->firstName,
    	'lastname' => $faker->lastName,
    	'area_code_phone_id' => 1,
    	'area_code_mobile_id' => 1,
    	'phone' => $faker->phoneNumber,
    	'mobile' => $faker->cellphone,
    	'email' => $faker->unique()->safeEmail,

    	'street' => $faker->streetName,
    	'street_number' => $faker->buildingNumber,
    	'locality_id' => $faker->numberBetween(1, 4),
    	'between_street_one' => $faker->streetName,
    	'between_street_two' => $faker->streetName,
    	'floor' => $isDepartment ? $faker->randomDigitNotNull : null,
    	'department' => $isDepartment ? $faker->randomLetter : null,

    	'latitude' => $faker->latitude($min = -57, $max = -59),
    	'longitude' => $faker->longitude($min = -34, $max = -35),

    	'facebook_nick' => $faker->sentence(1),
    	'facebook_verify' => $faker->boolean(),
    	'instagram_nick' => $faker->sentence(1),
    	'instagram_verify' => $faker->boolean(),
    	'twitter_nick' => $faker->sentence(1),
    	'twitter_verify' => $faker->boolean(),
    ];
});
