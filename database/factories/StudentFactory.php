<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fname' => $this->faker->firstName(),
            'mname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'contactInfo' => $this->faker->phoneNumber(),
            'degree_id' => Degree::inRandomOrder()->first()->id ?? 1,
        ];
    }
}
