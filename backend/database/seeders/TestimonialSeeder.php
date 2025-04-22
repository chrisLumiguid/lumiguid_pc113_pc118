<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::factory()->count(50)->create(); // Generate 50 testimonials
    }
}
