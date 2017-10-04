<?php

use Faker\Provider\es_ES\Person as SpanishPersonProvider;
use Faker\Generator as Faker;

$factory->define(App\API\v1\Models\Person::class, function (Faker $faker) {

    $faker->addProvider(new SpanishPersonProvider($faker));

    return [
        'name' => $faker->name,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'status' => null, // Relation
        'curp' => $faker->regexify('[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}'),
        'profile_picture' => null,
        'info_location' => null,
        'info_detail' => ''
    ];
});
