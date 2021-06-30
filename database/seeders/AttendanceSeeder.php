<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use Carbon\Carbon;
class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $faker=Faker::create('id_ID');
        $status=array("hadir","ijin","sakit","alpha");
        for($i=0;$i<100;$i++){
            $sc_id=\App\Models\Schedule::factory()->create();
            $st_id=\App\Models\student::factory()->create();
            $ac_id=\App\Models\Academic::factory()->create();
            $ka = array_rand($status);
            $start=$faker->time($format = 'H:i', $max = 'now');
            $end=Carbon::parse($start)->addHour(2)->format('H:i');
            DB::table('attendance')->insert([
                'schedule_id'=>$sc_id,
                'user_id'=>$st_id,
                'lesson_id'=>$ac_id,
                'date'=>$faker->date('Y-m-d'),
                'in'=>$start,
                'out'=>$end,
                'status'=>$status[$ka]
            ]);
        };
        */
        \App\Models\Attendance::factory(400)->create();
    }
}
