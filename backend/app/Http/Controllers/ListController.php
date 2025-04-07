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
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Made required
            'uploaded_file' => 'required|file|mimes:doc,pdf,docx|max:2048', // Made required
        ];

        if ($type === 'student') {
            $rules['year_level'] = 'required|integer';
            $rules['age'] = 'required|integer';
            $rules['student_id_number'] = 'required|string|unique:students,student_id_number';
        }

        if ($type === 'employee') {
            $rules['employee_id_number'] = 'required|string|unique:employees,employee_id_number';
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Handle file uploads
        // Profile picture upload
        if ($request->hasFile('profile_picture')) {
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Uploaded file handling
        if ($request->hasFile('uploaded_file')) {
            $validatedData['uploaded_file'] = $request->file('uploaded_file')->store('uploaded_files', 'public');
        }

        // Create the record
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

        // Validate data for updating
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
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Made required
            'uploaded_file' => 'required|file|mimes:doc,pdf,docx|max:2048', // Made required
        ]);

        // Handle file uploads if provided
        if ($request->hasFile('profile_picture')) {
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if ($request->hasFile('uploaded_file')) {
            $validatedData['uploaded_file'] = $request->file('uploaded_file')->store('uploaded_files', 'public');
        }

        // Update the model with the validated data
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

    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'addFile' => 'nullable|mimes:pdf,docx,zip|max:2048',
    ]);

    // Handle the profile picture upload
    $profilePicture = $request->file('profile_picture');
    $profilePicturePath = $profilePicture ? $profilePicture->store('profile_pictures', 'public') : null;

    // Handle other fields
    $employee = new Employee([
        'employee_id' => $request->employee_id,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'profile_picture' => $profilePicturePath,  // Save the file path
    ]);

    // Handle the file upload if exists
    if ($request->hasFile('addFile')) {
        $file = $request->file('addFile');
        $filePath = $file->store('employee_files', 'public');
        $employee->file = $filePath;
    }

    $employee->save();

    return response()->json([
        'message' => 'Employee added successfully!',
    ]);
}



}
