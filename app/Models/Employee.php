<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

     protected $table = 'employees';
    protected $fillable = [
        'employee_id_number', 
        'f_name', 
        'l_name', 
        'birth_date', 
        'age',
        'email', 
        'phone', 
        'address', 
        'gender', 
        'year_level', 
        'dept_id', 
        'program_id', 
        'status', 
        'guardian_name', 
    ];
}
