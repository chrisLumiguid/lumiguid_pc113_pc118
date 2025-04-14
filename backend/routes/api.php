<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/update-profile', [UserController::class, 'updateProfile']);


Route::post('/register', [UserController::class, 'register']); 

Route::post('/login', [UserController::class, 'login']); 

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth:sanctum');


Route::post('/create/{type}', [ListController::class, 'create']);
Route::get('/students', [ListController::class, 'getStudents']);
Route::get('/employees', [ListController::class, 'getEmployees']);
Route::get('/search', [ListController::class, 'search']);
Route::put('/update/{id}/{type}', [ListController::class, 'update']);
Route::delete('/delete/{id}/{type}', [ListController::class, 'delete']);

// Admin routes (only accessible for authenticated admins)
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () { 
    // Define any admin-specific routes here, for example:
    // Route::get('/dashboard', [AdminController::class, 'dashboard']);
});

// Admin Dashboard Route (accessible by authenticated users)
Route::middleware('auth:sanctum')->get('/admin/dashboard', function (Request $request) {
    return response()->json([
        'user' => \Illuminate\Support\Facades\Auth::user(),
        'headers' => $request->headers->all()
    ]);
});

// Test Auth Route (to test if the user is authenticated)
Route::middleware('auth:sanctum')->get('/test-auth', function (Request $request) {
    return response()->json(['message' => 'Authenticated', 'user' => \Illuminate\Support\Facades\Auth::user()]);
});
