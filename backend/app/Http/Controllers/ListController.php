<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Student;
use App\Models\Employee;
use Exception;
use Illuminate\Support\Facades\Log;

class ListController extends Controller {

    public function getEmployees() {
        try {
            $employees = Employee::all();
            return response()->json([
                'type' => 'Employees List',
                'data' => $employees
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getStudents() {
        try {
            $students = Student::all();
            return response()->json([
                'type' => 'Students List',
                'data' => $students
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function search(Request $request) {
        try {
            $search = $request->input('search');
            $type = $request->input('type'); 

            if (!$search) {
                return response()->json(['error' => 'Search query is required'], 400);
            }

            $students = collect();
            $employees = collect();

            if ($type === 'student' || !$type) {
                $students = Student::where('f_name', 'LIKE', "%{$search}%")
                    ->orWhere('l_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->get();
            }

            if ($type === 'employee' || !$type) {
                $employees = Employee::where('f_name', 'LIKE', "%{$search}%")
                    ->orWhere('l_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->get();
            }

            return response()->json([
                'students' => $students,
                'employees' => $employees
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




public function create(Request $request, $type) {
    try {
        Log::info('Create request received', $request->all());

        
        $type = strtolower($type);

        
        if (!in_array($type, ['student', 'employee'])) {
            return response()->json(['error' => 'Invalid type provided.'], 400);
        }

        $table = $type === 'student' ? 'students' : 'employees';

        $rules = [
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email|unique:' . $table . ',email',
            'phone' => 'required|string|unique:' . $table . ',phone',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'guardian_name' => 'required|string',
            'age' => 'required|integer',
        ];

        if ($type === 'student') {
            $rules['year_level'] = 'required|integer';
            $rules['age']  = 'required|integer';
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
    } catch (\Exception $e) {
        Log::error('Error creating record: ' . $e->getMessage());
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
        Log::info("Updating {$type} with ID: {$id}");

        $table = $type === 'student' ? 'students' : 'employees';
        $model = $type === 'student' ? Student::find($id) : Employee::find($id);

        if (!$model) {
            Log::error("{$type} not found with ID: {$id}");
            return response()->json(['message' => ucfirst($type) . ' not found'], 404);
        }

        Log::info('Model found:', ['model' => $model]);

        // Allow fields to be optional during update
        $validatedData = $request->validate([
            'f_name' => 'sometimes|required|string',
            'l_name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:' . $table . ',email,' . $id,
            'phone' => 'sometimes|required|string|unique:' . $table . ',phone,' . $id,
            'year_level' => 'sometimes|integer',
            'birth_date' => 'sometimes|date',
            'age' => 'sometimes|integer',
            'address' => 'sometimes|string',
            'gender' => 'sometimes|in:Male,Female',
            'guardian_name' => 'sometimes|string',
        ]);

        Log::info('Validated data:', ['data' => $validatedData]);

        // Update only the fields sent by the user
        $model->update($validatedData);

        return response()->json([
            'message' => ucfirst($type) . ' updated successfully!',
            $type => $model,
        ]);
    } catch (Exception $e) {
        Log::error('Error updating record: ' . $e->getMessage());
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
