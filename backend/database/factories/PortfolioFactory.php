<?php
namespace Database\Factories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition()
    {
        return [
            'portfolio_owner_id' => \App\Models\PortfolioOwner::factory(), // Automatically create a related portfolio owner
            'title' => $this->faker->sentence(5), // Random title with 5 words
            'description' => $this->faker->paragraph(), // Random description
            'cover_image' => 'https://source.unsplash.com/800x600/?design', // Unsplash random design-related image
            'gallery_images' => json_encode([
                'https://source.unsplash.com/800x600/?art',
                'https://source.unsplash.com/800x600/?technology',
                'https://source.unsplash.com/800x600/?innovation'
            ]), // Random gallery images from Unsplash
            'category' => $this->faker->word(), // Random category
            'tags' => json_encode($this->faker->words(5)), // Random tags as JSON
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']), // Random status
        ];
    }
}
