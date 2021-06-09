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
        for($i=0;$i<20;$i++){
            $start=$faker->time($format = 'H:i', $max = 'now');
            $end=Carbon::parse($start)->addHour(2)->format('H:i');
            \DB::table('schedules')->insert([
                'academic_id'=>$faker->randomDigit,
                'grade_id'=>$faker->randomDigit,
                'teacher_id'=>$faker->randomDigit,
                'day'=>$faker->dayOfWeek($max = 'now'),
                'start'=>$start,
                'end'=>$end,
                'status'=>"Belum dimulai",
            ]);
        };
    }
}
