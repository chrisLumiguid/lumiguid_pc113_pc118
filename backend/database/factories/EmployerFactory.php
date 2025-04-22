<?php
namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployerFactory extends Factory
{
    protected $model = Employer::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Create a related user automatically
            'company_name' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
            'company_description' => $this->faker->paragraph(),
            'company_website' => $this->faker->url(),
            'contact_number' => $this->faker->phoneNumber(),
        ];
    }
}
