<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Animal;
use Faker\Generator as Faker;

$factory->define(Animal::class, function (Faker $faker) {
    $type = factory(App\AnimalType::class)->create();
    $breed = factory(App\AnimalBreed::class)->create();
    $user = factory(App\User::class)->create();

    return [
        'name' => $faker->name,
        'age' => $faker->randomDigit,
        'photo' => '',
        'type_id' => $type->id,
        'breed_id' => $breed->id,
        'user_id' => $user->id
    ];
});
