<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create('id_ID');
        for($i=0;$i<20;$i++){
            \DB::table('students')->insert([
                'name'=>$faker->name,
                'nis'=>$faker->numberBetween(1000000000,1999999999),
                'grade_id'=>$faker->randomDigit,
                'address'=>$faker->address,
                'hp'=>$faker->phoneNumber
            ]);
        };
    }
}