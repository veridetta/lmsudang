<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapel = array("X IPA 1","X IPA 2","X IPA 3","XI IPA 1","XI IPA 2","XII IPA 1","XII IPA 2","XII IPA 3");
        $code=array("XIPA1","XIPA2","XIPA3","XIIPA1","XIIPA2","XIIPA3","XIIIPA1","XIIIPA2","XIIIPA3");
        for($i=0;$i<count($mapel);$i++){
            \DB::table('grades')->insert([
                'name'=>$mapel[$i],
                'code'=>$code[$i]
            ]);
        };
        //\App\Models\Grade::factory(6)->create();
    }
}
