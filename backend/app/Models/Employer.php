<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'position',
        'company_description',
        'company_website',
        'contact_number',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
