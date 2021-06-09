<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapel = array("Matematika","Fisika","Kimia", "Biologi","Bahasa Indonesia","Bahasa Inggris","Matematika","Fisika","Kimia", "Biologi","Bahasa Indonesia","Bahasa Inggris");
        for($i=0;$i<count($mapel);$i++){
            \DB::table('academics')->insert([
                'name'=>$mapel[$i]
            ]);
        };
    }
}
