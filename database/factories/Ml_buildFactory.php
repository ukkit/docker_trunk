<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ml_build;
use Faker\Generator as Faker;

$factory->define(Ml_build::class, function (Faker $faker) {
    return [
        'ml_version' => $faker->word,
        'ml_build' => $faker->randomDigitNotNull,
        'pv_id' => $faker->word,
        'is_release_build' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
