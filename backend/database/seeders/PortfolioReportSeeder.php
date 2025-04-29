<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioReport;

class PortfolioReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         PortfolioReport::factory()->count(5)->create();
    }
}
