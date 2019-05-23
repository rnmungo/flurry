<?php

use Faker\Generator as Faker;
use Flurry\Role;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Flurry\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 		// 'secret' encriptado
        'remember_token' => str_random(10),
        'random_id' => uniqid(str_random(17)),
        'role_id' => $faker->numberBetween(1, 4),
    ];
});

$admin_role      = Role::where('name', 'Admin')->first();
$operator_role   = Role::where('name', 'Operator')->first();
$supervisor_role = Role::where('name', 'Supervisor')->first();
$manager_role    = Role::where('name', 'Manager')->first();

$factory->state(Flurry\User::class, 'admin', ['role_id' => $admin_role->id]);
$factory->state(Flurry\User::class, 'operator', ['role_id' => $operator_role->id]);
$factory->state(Flurry\User::class, 'supervisor', ['role_id' => $supervisor_role->id]);
$factory->state(Flurry\User::class, 'manager', ['role_id' => $manager_role->id]);
