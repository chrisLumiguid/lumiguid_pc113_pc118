<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;

class UserController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'device_name' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        // $token = $user->createToken($request->device_name ?? 'default_token')->plainTextToken;
    
        // $token = $user->createToken('postman', ['*'])->plainTextToken;

        $token = $user->createToken('auth_token')->plainTextToken;
        $tokenParts = explode('|', $token);
        $tokenOnly = $tokenParts[1] ?? $token;

        return response()->json([
            'message' => 'Login successful',
            'token' => $tokenOnly, //$token
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }
}
