<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    // This is the code for Activity 2 : Search
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

        return response()->json($query->get());
    }



    // CREATE
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'student_id_number' => 'required|string|unique:students,student_id_number',
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|unique:students,phone',
            'birth_date' => 'required|date',
            'age' => 'required|integer',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'year_level' => 'required|integer',
            'guardian_name' => 'required|string',
        ]);

        $student = Student::create($validatedData);
        return response()->json([
            'message' => 'Student created succesfully',
            'student' => $student,
        ], 201);

        if (Student::where($validatedData)->exists()) {
            return response()->json(['message' => 'Error: Duplicate data found'], 400);
        }
    }

    // SHOW
    public function show(string $id)
    {
        $student = Student::find($id);

        if ($student === null) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    // UPDATE
    public function update(Request $request, string $id)
    {
        $student = student::find($id);

        if (is_null($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validatedData = $request->validate([
            'student_id_number' => 'required|string|unique:students,student_id_number',
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|string|max:15|unique:students,phone',
            'birth_date' => 'required|date',
            'age' => 'required|integer|min:18|max:65',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'year_level' => 'required|integer',
            'guardian_name' => 'required|string|max:255',
        ]);

        $student->update($validatedData);

        return response()->json([
            'message' => 'Student updated successfully!',
            'student' => $student,
        ]);

        if (Student::where($validatedData)->exists()) {
            return response()->json(['message' => 'Error: Duplicate data found'], 400);
        }
    }

    // DELETE
    public function destroy(string $id)
    {
        $student = Student::find($id);

        if ($student === null) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully!']);
    }


    
}