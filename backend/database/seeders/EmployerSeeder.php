<?php
namespace Database\Seeders;

use App\Models\Employer;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    public function run()
    {
        Employer::factory()->count(50)->create(); 
    }
}

