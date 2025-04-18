<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PortfolioOwner;
use App\Models\Project;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'portfolio_owner_id',
        'title',
        'description',
        'cover_image',
        'gallery_images',
        'category',
        'tags',
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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
