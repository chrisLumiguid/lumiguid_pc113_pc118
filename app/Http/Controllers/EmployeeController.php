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




class EmployeeController extends Controller
{

    // This is the code for Activity 2 : Search
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

        return response()->json($query->get());
    }

    
    // CREATE
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id_number' => 'required|string|unique:employees,employee_id_number',
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string'|'unique:employees',
            'birth_date' => 'required|date',
            'age' => 'required|integer',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'guardian_name' => 'required|string',
        ]);

        $employee = Employee::create($validatedData);
        return response()->json([
            'message' => 'Employee created succesfully',
            'employee' => $employee,
        ], 201);

    if (Employee::where($validatedData)->exists()) {
        return response()->json(['message' => 'Error: Duplicate data found'], 400);
    }


    }

    // SHOW
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if ($employee === null) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json($employee);
    }

    // UPDATE
    public function update(Request $request, string $id)
    {
        $employee = employee::find($id);

        if (is_null($employee)) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validatedData = $request->validate([
            'employee_id_number' => 'required|string|unique:employees,employee_id_number',
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'required|string|max:15|unique:employees,phone',
            'birth_date' => 'required|date',
            'age' => 'required|integer|min:18|max:65',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'guardian_name' => 'required|string|max:255',
        ]);

        $employee->update($validatedData);

        return response()->json([
            'message' => 'Employee updated successfully!',
            'employee' => $employee,
        ]);

        if ($employee === null) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        if (Employee::where($validatedData)->exists()) {
            return response()->json(['message' => 'Error: Duplicate data found'], 400);
        }
    }

    // DELETE
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if ($employee === null) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted sucessfully!']);
    }
}