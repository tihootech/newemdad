<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobApply;
use App\LoanApply;
use App\InsuranceApply;
use Faker\Generator as Faker;

$factory->define(JobApply::class, function (Faker $faker) {

    $vihicles = defaults('vehicle_type');

    return [
        'person_id' => rand(1,251),
        'uid' => rand(100000000,999999999),
        'skill_type' => $faker->sentence(5),
        'interests' => $faker->sentence(),
        'vehicle_type' => $vihicles[array_rand($vihicles)],
        'status' => 4
    ];
});

$factory->define(LoanApply::class, function (Faker $faker) {
    return [
        'person_id' => rand(1,500),
        'uid' => rand(100000000,999999999),
        'workshop_name' => $faker->word,
        'license_type' => $faker->word,
        'license_system' => $faker->word,
        'plan_title' => $faker->word,
        'required_finance' => rand(1,16) * 2500000,
        'suggested_bank' => $faker->word,
        'insurance_number' => rand(1000000000,99999999999),
        'status' => 4
    ];
});

$factory->define(InsuranceApply::class, function (Faker $faker) {

    $insurances = defaults('insurance_status');

    return [
        'person_id' => rand(1,251),
        'uid' => rand(100000000,999999999),
        'license_type' => $faker->word,
        'license_system' => $faker->word,
        'plan_title' => $faker->word,
        'insurance_status' => $insurances[array_rand($insurances)],
        'insurance_number' => rand(1000000000,99999999999),
        'workshop_name' => $faker->word,
        'monthly_amount' => rand(1,16) * 2500000,
        'shaba' => 'IR'.rand(100000000000,9999999999999),
        'bank' => $faker->word,
        'status' => 4
    ];
});
