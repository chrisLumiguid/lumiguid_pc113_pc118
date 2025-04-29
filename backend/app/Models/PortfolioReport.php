<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioReport extends Model
{
     use HasFactory;

    protected $fillable = [
        'portfolio_id', 'title', 'description', 'status'
    ];

    // Define the relationship to Portfolio (1 report belongs to 1 portfolio)
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
