<?php
namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition()
    {
        return [
            'portfolio_owner_id' => \App\Models\User::factory(), // Link to a generated user (portfolio owner)
            'employer_id' => \App\Models\User::factory(), // Link to a generated user (employer)
            'rating' => $this->faker->numberBetween(1, 5), // Random rating between 1 and 5
            'testimonial_content' => $this->faker->paragraph(), // Random testimonial content
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']), // Random status
        ];
    }
}
