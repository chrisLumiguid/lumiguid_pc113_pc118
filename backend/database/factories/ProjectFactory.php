<?php
namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'portfolio_owner_id' => \App\Models\PortfolioOwner::factory(), // Generate a related portfolio owner
            'portfolio_id' => \App\Models\Portfolio::factory(), // Generate a related portfolio
            'title' => $this->faker->sentence(6), // Random title with 6 words
            'description' => $this->faker->paragraph(), // Random description
            'cover_image' => 'https://source.unsplash.com/800x600/?project', // Unsplash random project-related image
            'gallery_images' => json_encode([
                'https://source.unsplash.com/800x600/?design',
                'https://source.unsplash.com/800x600/?architecture',
                'https://source.unsplash.com/800x600/?art',
            ]), // Random gallery images
            'video_url' => $this->faker->url(), // Random video URL
            'category' => $this->faker->word(), // Random category
            'tags' => json_encode($this->faker->words(5)), // Random tags as JSON
            'date_completed' => $this->faker->date(),
            'client_name' => $this->faker->name(), // Random client name
            'project_url' => $this->faker->url(), // Random project URL
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']), // Random status
        ];
    }
}
