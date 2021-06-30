<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Faker\Factory as Faker;
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker=Faker::create('id_ID');
        $ext=array("jpg","pdf","docx","pptx");
        $sc_id=\App\Models\Schedule::inRandomOrder()->first();
            //$st_id=\App\Models\student::factory()->create();
            $st_id=\App\Models\student::where('grade_code','=',$sc_id->grade_code)->inRandomOrder()->first();
            $ac_id=\App\Models\Academic::where('code','=',$sc_id->academic_code)->inRandomOrder()->first();
            $att_id=\App\Models\Attendance::where('schedule_id','=',$sc_id->id)->inRandomOrder()->first();
            $ka = array_rand($ext);
            $start=$faker->time($format = 'H:i', $max = 'now');
            $end=Carbon::parse($start)->addHour(2)->format('H:i');
        return [
            'schedule_id'=>$sc_id->id,
                'student_id'=>$st_id->id,
                'academic_id'=>$ac_id->id,
                'attendance_id'=>$att_id->id,
                'title'=>$faker->userAgent(),
                'content'=>$faker->text(200),
                'file_name'=>$faker->languageCode(),
                'path'=>$faker->languageCode().$ext[$ka],
                'submit'=>$faker->date('Y-m-d')
        ];
    }
}
