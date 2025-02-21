<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

// This is the original code for Activity 1

// class StudentController extends Controller
// {
//     public function index()
//     {
//         return response()->json(Student::all());
//     }
// }

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('f_name', 'LIKE', "%{$search}%") 
                  ->orWhere('l_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
        }

        $students = $query->get();

        return response()->json($students);
    }
}