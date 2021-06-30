<?php

namespace Database\Factories;

use App\Models\student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Faker\Factory as Faker;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker=Faker::create('id_ID');
        $sc_id=\App\Models\Grade::inRandomOrder()->first();
        return [
                'name'=>$faker->name,
                'nis'=>$faker->numberBetween(1000000000,1999999999),
                'grade_code'=>$sc_id->code,
                'address'=>$faker->address,
                'hp'=>$faker->phoneNumber
        ];
    }
}
