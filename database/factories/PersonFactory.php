<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {

    $cities = defaults('city');
    $educations = defaults('education');
    $lifestyles = defaults('lifestyle');
    $maritals = defaults('marital_status');
    $genders = defaults('gender');
    $domains = defaults('file_domain');
    $wardens = defaults('warden_type');
    $healths = defaults('health_status');
    $file_status = defaults('file_status_'.rand(1,2));
    $persian_date = rand(1350,1380).'/'.rand(1,12).'/'.rand(1,29);

    return [
        'user_id' => rand(100,200),
        'state' => 'کرمانشاه',
        'city' => $cities[array_rand($cities)],
        'lifestyle' => $lifestyles[array_rand($lifestyles)],
        'address' => $faker->address,
        'postal_code' => rand(1000000000,99999999999),
        'national_code' => rand(1000000000,99999999999),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'father_name' => $faker->firstNameMale,
        'birth_date' => $persian_date,
        'english_birth_date' => persian_to_carbon($persian_date),
        'birth_certificate_number' => rand(1000000000,99999999999),
        'madadkar_name' => $faker->name,
        'marital_status' => $maritals[array_rand($maritals)],
        'family_members' => rand(3,8),
        'gender' => $genders[array_rand($genders)],
        'education' => $educations[array_rand($educations)],
        'warden_type' => $wardens[array_rand($wardens)],
        'health_status' => $healths[array_rand($healths)],
        'disables_in_family' => rand(0,2),
        'mobile' => $faker->e164PhoneNumber,
        'file_domain' => $domains[array_rand($domains)],
        'file_status' => $file_status[array_rand($file_status)],
    ];
});
