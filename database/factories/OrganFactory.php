<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Organ;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Organ::class, function (Faker $faker) {

    $cities = defaults('city');
    $educations = defaults('education');
    $locations = defaults('workshop_location');
    $bools = defaults();
    $meals = defaults('meal');
    $amounts = defaults('payment_amount');

    return [
        'uid' => rand(100000000,999999999),
        'user_id' => rand(100,200),
        'state' => 'کرمانشاه',
        'city' => $cities[array_rand($cities)],
        'in_charge_first_name' => $faker->firstName,
        'in_charge_last_name' => $faker->lastName,
        'national_code' => rand(1000000000,99999999999),
        'birth_date' => rand(1350,1380).'/'.rand(1,12).'/'.rand(1,29),
        'educations' => $educations[array_rand($educations)],
        'workshop_location' => $locations[array_rand($locations)],
        'workshop_title' => $faker->streetName,
        'address' => $faker->address,
        'postal_code' => rand(1000000000,99999999999),
        'service' => $bools[array_rand($bools)],
        'shifts' => $bools[array_rand($bools)],
        'shift_hours' => rand(1,12).'-'.rand(13,20),
        'meal' => $meals[array_rand($meals)],
        'payment_amount' => $amounts[array_rand($amounts)],
        'offered_payment' => rand(1,8) * 5000000,
        'madadjus_insurance' => $bools[array_rand($bools)],
        'full_insurance' => $bools[array_rand($bools)],
        'phone' => $faker->e164PhoneNumber,
        'status' => rand(1,4),
    ];
});
