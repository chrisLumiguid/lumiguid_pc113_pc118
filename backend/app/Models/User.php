<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;     

/**
 * @property-read \App\Models\Employer|null $employer
 */
class User extends Authenticatable
{   
    use HasApiTokens, HasFactory, Notifiable;
        
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function portfolioOwner()
    {
        return $this->hasOne(PortfolioOwner::class);
    }

    public function employer()
    {
        return $this->hasOne(\App\Models\Employer::class);
    }


    public function tokens()
    {
        return $this->hasMany(PersonalAccessToken::class);
    }

    public function getProfileImageUrlAttribute() {
    // If no image is available, return initials
    if (!$this->profile_image) {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
    $disk = Storage::disk('public');
    return $disk->url($this->profile_image);
    }

}
