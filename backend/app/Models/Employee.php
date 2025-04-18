<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'guardian_name',
    ];
}
