<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AnimalType;
use Faker\Generator as Faker;

$factory->define(AnimalType::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
