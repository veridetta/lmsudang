<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create('id_ID');
        $academic=array("TU","IT","Keuangan","Manajemen","Admin");
        for($i=0;$i<10;$i++){
            $ka = array_rand($academic);
            \DB::table('staff')->insert([
                'name'=>$faker->name,
                'nip'=>$faker->numberBetween(1000000000,1999999999),
                'academic'=>$academic[$ka],
                'address'=>$faker->address,
                'hp'=>$faker->phoneNumber
            ]);
        };

    }
}
