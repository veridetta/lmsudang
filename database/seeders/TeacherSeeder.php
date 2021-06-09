<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create('id_ID');
        for($i=0;$i<15;$i++){
            \DB::table('teachers')->insert([
                'name'=>$faker->name,
                'nip'=>$faker->numberBetween(1000000000,1999999999),
                'lesson_id'=>$faker->randomDigit,
                'address'=>$faker->address,
                'hp'=>$faker->phoneNumber
            ]);
        };
    }
}
