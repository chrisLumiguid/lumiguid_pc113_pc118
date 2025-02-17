<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id_number' => $this->faker->unique()->numerify('S####'),
            'f_name' => $this->faker->firstName,
            'l_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date,
            'age' => $this->faker->numberBetween(18, 25),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'year_level' => $this->faker->numberBetween(1, 4),
            'dept_id' => $this->faker->numberBetween(1, 10),
            'program_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'guardian_name' => $this->faker->name,
        ];
    }
}