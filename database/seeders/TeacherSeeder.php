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
        $academic=array("MAT","FIS","KIM","BIO","BIND","BING","MAT2","FIS2","KIM2","BIO2","BIND2","BING2");
        for($i=0;$i<25;$i++){
            $ka = array_rand($academic);
            \DB::table('teachers')->insert([
                'name'=>$faker->name,
                'nip'=>$faker->numberBetween(1000000000,1999999999),
                'academic_code'=>$academic[$ka],
                'address'=>$faker->address,
                'hp'=>$faker->phoneNumber
            ]);
        };
    }
}
