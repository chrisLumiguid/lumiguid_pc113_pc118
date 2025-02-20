<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;


// This is the original code for Activity 1

// class EmployeeController extends Controller
// {
//     public function index()
//     {
//         return response()->json(Employee::all());
//     }
// }


// This is the code for Activity 2
class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('f_name', 'LIKE', "%{$search}%")
                  ->orWhere('l_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
        }

        $employees = $query->get();

        return response()->json($employees);
    }
}