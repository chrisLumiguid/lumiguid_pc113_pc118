<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\PortfolioReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioReportFactory extends Factory
{
    protected $model = PortfolioReport::class;

    public function definition()
    {
        return [
            'portfolio_id' => Portfolio::inRandomOrder()->first()->id, 
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['draft', 'submitted', 'reviewed']),
        ];
    }
}
