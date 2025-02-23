<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id_number' => $this->faker->unique()->numerify('S####'),
            'f_name' => $this->faker->firstName,
            'l_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date,
            'age' => $this->faker->numberBetween(18, 25),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'guardian_name' => $this->faker->name,
        ];
    }
}
