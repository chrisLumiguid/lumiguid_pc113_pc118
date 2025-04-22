<?php
namespace Database\Seeders;

use App\Models\PortfolioOwner;
use Illuminate\Database\Seeder;

class PortfolioOwnerSeeder extends Seeder
{
    public function run()
    {
        PortfolioOwner::factory()->count(50)->create();
    }
}
