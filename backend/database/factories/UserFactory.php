<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('Password123!'), // Default password for all seeded users
            'role' => $this->faker->randomElement(['guest', 'portfolio_owner', 'employer', 'admin']),
        ];
    }
}

