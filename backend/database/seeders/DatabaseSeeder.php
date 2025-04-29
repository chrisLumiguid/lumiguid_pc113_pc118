<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(EmployerSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(PortfolioSeeder::class); 
        $this->call(EmployeeSeeder::class);
        $this->call(PortfolioOwnerSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(PortfolioReportSeeder::class);
    }
}
