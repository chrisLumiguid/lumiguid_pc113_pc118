<?php
namespace Database\Factories;

use App\Models\PortfolioOwner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioOwnerFactory extends Factory
{
    protected $model = PortfolioOwner::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Automatically create a related user
            'headline' => $this->faker->jobTitle(),
            'about' => $this->faker->paragraph(),
            'skills' => implode(',', $this->faker->words(5)), // Random skills as a comma-separated string
            'current_company' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
            'experience_summary' => $this->faker->paragraph(),
            'education_summary' => $this->faker->paragraph(),
            'social_links' => json_encode([
                'linkedin' => $this->faker->url(),
                'github' => $this->faker->url(),
            ]),
            'personal_website' => $this->faker->url(),
            'portfolio_overview' => $this->faker->paragraph(),
            'profile_banner' => 'https://source.unsplash.com/1200x300/?business', // Unsplash random business-related image
            'profile_picture' => 'https://source.unsplash.com/300x300/?face', // Unsplash random portrait image
            'resume' => 'resumes/sample.pdf', // You can replace this with a realistic path
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
