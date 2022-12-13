<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Jenkins_credential;
use Faker\Generator as Faker;

$factory->define(Jenkins_credential::class, function (Faker $faker) {

    return [
        'server_name_ip' => $faker->word,
        'jenkins_user' => $faker->word,
        'jenkins_token' => $faker->text,
        'note' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
