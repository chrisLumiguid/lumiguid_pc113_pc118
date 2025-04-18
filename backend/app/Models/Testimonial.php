<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_owner_id',
        'employer_id',
        'rating',
        'testimonial_content',
        'status',
    ];

    // Portfolio owner relationship (user who receives testimonial)
    public function portfolioOwner()
    {
        return $this->belongsTo(User::class, 'portfolio_owner_id');
    }

    // Employer relationship (user who gives the testimonial)
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}

