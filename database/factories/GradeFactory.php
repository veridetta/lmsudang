<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class GradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker=Faker::create('id_ID');
            return [
                'name'=>$faker->text(6),
                'code'=>$faker->regexify('[A-Za-z0-9]{'.(mt_rand(10,14)).'}'),
            ];
    }
}
