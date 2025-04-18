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
        'social_links',
        'personal_website',
        'portfolio_overview',
        'profile_banner',
        'profile_picture',
        'resume',
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
