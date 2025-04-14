<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Create User (Registration)
public function register(Request $request)
{
    try {
        // Validate essential fields only
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Set default role to 'user'
        $data['role'] = 'user';

        // Create the user
        $user = User::create($data);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    } catch (\Exception $e) {
        Log::error('Registration error: ' . $e->getMessage());
        return response()->json([
            'message' => 'Registration failed',
            'error' => $e->getMessage()
        ], 500);
    }
}



    // User Login
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json(['message' => 'Invalid email or password'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
{
    try {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $data = $request->validate([
            'firstName' => 'nullable|string',
            'lastName' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'organization' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fileUpload' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('user_profiles', 'public');
        }

        if ($request->hasFile('fileUpload')) {
            $data['uploaded_file'] = $request->file('fileUpload')->store('user_files', 'public');
        }

        // Combine first and last name into name
        $data['name'] = trim(($data['firstName'] ?? $user->name) . ' ' . ($data['lastName'] ?? ''));

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Update failed',
            'error' => $e->getMessage()
        ], 500);
    }
}




}

