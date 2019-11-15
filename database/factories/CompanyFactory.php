<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Illuminate\Http\File;


use Faker\Generator as Faker;


$factory->define(/**
 * @param \Faker\Generator $faker
 *
 * @return array
 */ Company::class, function (Faker $faker) {
    $image = $faker->image();
    $imageFile = new File($image);

    return [

        'name'=>$faker->company,
        'email'=>$faker->companyEmail,
        'logo'=>Storage::putFile('logos',$imageFile),
        'website'=>'www.'.str_replace(" ","",strtolower($faker->company)).'.com'
    ];
});
