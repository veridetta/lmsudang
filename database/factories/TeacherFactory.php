<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker=Faker::create('id_ID');
        $sc_id=\App\Models\Academic::inRandomOrder()->first();
        return [
            'name'=>$faker->name,
                'nip'=>$faker->numberBetween(1000000000,1999999999),
                'academic_code'=>$sc_id->code,
                'address'=>$faker->address,
                'hp'=>$faker->phoneNumber
        ];
    }
}
