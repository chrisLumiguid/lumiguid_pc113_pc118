<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio;


class PortfolioOwner extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'headline',
    'about',
    'skills',
    'current_company',
    'position',
    'experience_summary',
    'education_summary',
    'portfolio_overview',
    'profile_picture',
    'resume',
    'profile_banner',
    'social_links',
    'personal_website',
    'location',
    'phone',
    'contact_email',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
