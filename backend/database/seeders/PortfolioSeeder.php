<?php
namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        Portfolio::factory()->count(5)->create();
    }
}

