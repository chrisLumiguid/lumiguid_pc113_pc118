<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Routing\Controller;
use App\Models\User;


class UserController extends Controller
{
    // Create User
    public function create(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|in:admin,user',
            ]);

            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
        }
    }

    // User Login
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
                // 'device_name' => 'required|string',
            ]);

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json(['message' => 'Invalid email or password'], 401);
            }

            // **Delete previous tokens to ensure only one active token per user**
            $user->tokens()->delete();

            $token = $user->createToken('auth_token')->plainTextToken;
            $tokenParts = explode('|', $token);
            $tokenOnly = $tokenParts[1] ?? $token;

            return response()->json([
                'message' => 'Login successful',
                'token' => $tokenOnly,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong during login', 'error' => $e->getMessage()], 500);
        }
    }



    // Get Authenticated User Profile
    public function profile()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch user profile', 'error' => $e->getMessage()], 500);
        }
    }

    // User Logout
    // public function logout(Request $request)
    // {
    //     try {
    //         $request->user()->tokens()->delete();

    //         return response()->json(['message' => 'Logged out successfully']);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Failed to logout', 'error' => $e->getMessage()], 500);
    //     }
    // }
    public function logout(Request $request)
{
    try {
        if (Auth::guard('sanctum')->check()) {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to logout', 'error' => $e->getMessage()], 500);
    }
}


}
