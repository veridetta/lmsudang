<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Carbon\Carbon;
class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker=Faker::create('id_ID');
        $gr_id=\App\Models\Grade::inRandomOrder()->first();
            //$sc_id=\App\Models\Academic::inRandomOrder()->first();
            $tc_id=\App\Models\Teacher::inRandomOrder()->first();
                $start=$faker->time($format = 'H:i', $max = 'now');
                $end=Carbon::parse($start)->addHour(2)->format('H:i');
        return [    
                    'academic_code'=>$tc_id->academic_code,
                    'grade_code'=>$gr_id->code,
                    'teacher_nip'=>$tc_id->nip,
                    'day'=>$faker->dayOfWeek($max = 'now'),
                    'start'=>$start,
                    'end'=>$end,
                    'status'=>"Belum dimulai",

        ];
    }
}
