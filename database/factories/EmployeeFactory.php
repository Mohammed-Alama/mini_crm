<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Company;
use App\Employee;
use Faker\Generator as Faker;

$factory->define(/**
 * @param \Faker\Generator $faker
 *
 * @return array
 */ Employee::class, function (Faker $faker) {
    return [
        'company_id'=>factory(Company::class)->create()->id,
        'first_name'=>$faker->name,
        'last_name'=>$faker->name,
        'email'=>$faker->email,
        'name'=> $faker->words(2),
        'phone'=>$faker->phoneNumber,§
    ];
});
