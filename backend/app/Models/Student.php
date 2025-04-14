<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'student_id_number',
        'f_name', 
        'l_name', 
        'birth_date', 
        'email', 
        'phone', 
        'address', 
        'gender', 
        'guardian_name', 
        'year_level', 
        'age',

    ];
}

    

    