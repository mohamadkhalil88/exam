<?php

use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {

    return [
        'page_link' => $faker->url,
        'page_lang' => $faker->languageCode,
        'page_location'=> $faker->longitude.",".$faker->latitude,
        'page_location_name'=>$faker->address,
        'page_category'=>str_random(10),
        'page_area'=>'#'.str_random(5),
        'page_freq'=>' * '.rand(0,23).' * * * * ',
        'page_next_time'=>date("Y-m-d H:i:s"),
        'page_last_time'=>$faker->dateTime('now')
    ];
});
