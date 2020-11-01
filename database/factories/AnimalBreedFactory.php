<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AnimalBreed;
use Faker\Generator as Faker;

$factory->define(AnimalBreed::class, function (Faker $faker) {
    return [
        'breed_name' => $faker->word,
    ];
});
