<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;
Use Carbon\Carbon;
Use Faker\Factory as Faker;
class AttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker=Faker::create('id_ID');
        $status=array("hadir","ijin","sakit","alfa");
        $sc_id=\App\Models\Schedule::inRandomOrder()->first();
            $st_id=\App\Models\student::where('grade_code','=',$sc_id->grade_code)->inRandomOrder()->first();
            $ac_id=\App\Models\Academic::where('code','=',$sc_id->academic_code)->inRandomOrder()->first();
           // $ac_id=\App\Models\Academic::factory()->create();
            $ka = array_rand($status);
            $start=$faker->time($format = 'H:i', $max = 'now');
            $end=Carbon::parse($start)->addHour(2)->format('H:i');
        return [
                'schedule_id'=>$sc_id->id,
                'user_id'=>$st_id->id,
                'lesson_id'=>$ac_id->id,
                'date'=>$faker->date('Y-m-d'),
                'in'=>$start,
                'out'=>$end,
                'status'=>$status[$ka]
        ];
    }
}
