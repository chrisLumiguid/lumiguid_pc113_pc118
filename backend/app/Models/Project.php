<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio;
use App\Models\PortfolioOwner;


class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'portfolio_owner_id',
        'portfolio_id',  // This will link the project to a specific portfolio
        'title',
        'description',
        'cover_image',
        'gallery_images',
        'video_url',
        'category',
        'tags',
        'date_completed',
        'client_name',
        'project_url',
        'status',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'tags' => 'array',
    ];

    public function portfolioOwner()
    {
        return $this->belongsTo(PortfolioOwner::class);
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
