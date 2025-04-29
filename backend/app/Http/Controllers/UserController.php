<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'guest'
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User registered successfully.',
                'token' => $token,
                'user' => $user
            ], 201);

        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Registration failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // User login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ]
    ]);
    }




    // 🔒 Logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully.'
        ]);
    }


public function updateProfile(Request $request)
{
    $user = $request->user(); 

    
    $validated = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id, 
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:800',
        'resume' => 'nullable|file|mimes:pdf,docx|max:2048', 
    ]);

   
    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $path = $file->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }

    
    if ($request->hasFile('resume')) {
        $resumeFile = $request->file('resume');
        $resumePath = $resumeFile->store('resumes', 'public');
        $user->resume = $resumePath; 
    }


    $user->first_name = $request->firstName;
    $user->last_name = $request->lastName;
    $user->email = $request->email;
    $user->save();

    
    return response()->json([
        'message' => 'Profile updated successfully!',
        'user' => $user
    ]);
}
    // 🔐 Role check (example)
    public function adminOnly(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized. Admins only.'
            ], 403);
        }

        return response()->json([
            'message' => 'Welcome, admin.',
        ]);
    }
}
