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
        $grade=array("XIPA1","XIPA2","XIPA3","XIIPA1","XIIPA2","XIIPA3","XIIIPA1","XIIIPA2","XIIIPA3");
        for($i=0;$i<120;$i++){
            $kg = array_rand($grade);
            \DB::table('students')->insert([
                'name'=>$faker->name,
                'nis'=>$faker->numberBetween(1000000000,1999999999),
                'grade_code'=>$grade[$kg],
                'address'=>$faker->address,
                'hp'=>$faker->phoneNumber
            ]);
        };
    }
}