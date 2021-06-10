<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
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
        $grade=array("XIPA1","XIPA2","XIPA3","XIIPA1","XIIPA2","XIIPA3","XIIIPA1","XIIIPA2","XIIIPA3");
        for($i=0;$i<40;$i++){
            $ka = array_rand($academic);
            $kg = array_rand($grade);
            $start=$faker->time($format = 'H:i', $max = 'now');
            $end=Carbon::parse($start)->addHour(2)->format('H:i');
            \DB::table('schedules')->insert([
                'academic_code'=>$academic[$ka],
                'grade_code'=>$grade[$kg],
                'teacher_id'=>$faker->randomDigit,
                'day'=>$faker->dayOfWeek($max = 'now'),
                'start'=>$start,
                'end'=>$end,
                'status'=>"Belum dimulai",
            ]);
        };
    }
}
