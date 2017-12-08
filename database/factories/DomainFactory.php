<?php

use Faker\Generator as Faker;

$factory->define(App\Domain::class, function (Faker $faker) {
    return [
        'domain_name' => $faker->domainName,
        'domain_link' => $faker->url,
        'domain_lang' => $faker->languageCode,
        'domain_location' => $faker->longitude.",".$faker->latitude
    ];
});
