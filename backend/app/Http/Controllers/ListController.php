<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Student;
use App\Models\Employee;
use Exception;

class ListController extends Controller {

    public function index() {
        try {
            return response()->json([
                'students' => Student::all(),
                'employees' => Employee::all(),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request) {
        try {
            $search = $request->input('search');

            $students = Student::where('f_name', 'LIKE', "%{$search}%")
                            ->orWhere('l_name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%")
                            ->orWhere('phone', 'LIKE', "%{$search}%")
                            ->get();

            $employees = Employee::where('f_name', 'LIKE', "%{$search}%")
                            ->orWhere('l_name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%")
                            ->orWhere('phone', 'LIKE', "%{$search}%")
                            ->get();

            return response()->json([
                'students' => $students,
                'employees' => $employees
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request) {
        try {
            $type = $request->input('type');
            $table = $type === 'student' ? 'students' : 'employees';

            $rules = [
                'f_name' => 'required|string',
                'l_name' => 'required|string',
                'email' => 'required|email|unique:' . $table . ',email',
                'phone' => 'required|string|unique:' . $table . ',phone',
                'birth_date' => 'required|date',
                'age' => 'required|integer',
                'address' => 'required|string',
                'gender' => 'required|in:Male,Female',
                'guardian_name' => 'required|string',
            ];

            if ($type === 'student') {
                $rules['year_level'] = 'required|integer';
                $rules['student_id_number'] = 'required|string|unique:students,student_id_number';
            }

            if ($type === 'employee') {
                $rules['employee_id_number'] = 'required|string|unique:employees,employee_id_number';
            }

            $validatedData = $request->validate($rules);

            $record = $type === 'student' ? Student::create($validatedData) : Employee::create($validatedData);

            return response()->json([
                'message' => ucfirst($type) . ' created successfully',
                $type => $record
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id, $type) {
        try {
            $model = ($type === 'student') ? Student::find($id) : Employee::find($id);

            if (!$model) {
                return response()->json(['message' => ucfirst($type) . ' not found'], 404);
            }

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id, $type) {
        try {
            $table = $type === 'student' ? 'students' : 'employees';
            $model = $type === 'student' ? Student::find($id) : Employee::find($id);

            if (!$model) {
                return response()->json(['message' => ucfirst($type) . ' not found'], 404);
            }

            $validatedData = $request->validate([
                'f_name' => 'required|string',
                'l_name' => 'required|string',
                'email' => 'required|email|unique:' . $table . ',email,' . $id,
                'phone' => 'required|string|unique:' . $table . ',phone,' . $id,
                'birth_date' => 'required|date',
                'age' => 'required|integer',
                'address' => 'required|string',
                'gender' => 'required|in:Male,Female',
                'guardian_name' => 'required|string',
            ]);

            $model->update($validatedData);

            return response()->json([
                'message' => ucfirst($type) . ' updated successfully!',
                $type => $model,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id, $type) {
        try {
            $model = ($type === 'student') ? Student::find($id) : Employee::find($id);

            if (!$model) {
                return response()->json(['message' => ucfirst($type) . ' not found'], 404);
            }

            $model->delete();

            return response()->json(['message' => ucfirst($type) . ' deleted successfully!']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
