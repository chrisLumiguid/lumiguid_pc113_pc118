<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create-user', [UserController::class, 'create']);

Route::get('/index', [UserController::class, 'index']);
Route::get('/profile', [UserController::class, 'profile']);

Route::post('/create', [ListController::class, 'create']);
Route::get('/students', [ListController::class, 'getStudents']);
Route::get('/employees', [ListController::class, 'getEmployees']); 
Route::post('/login', [UserController::class, 'login']);


Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('/search-employees', [ListController::class, 'searchEmployees']);
    Route::get('/search-students', [ListController::class, 'searchStudents']);
    

    Route::put('/update/{id}/{type}', [ListController::class, 'update']);
    Route::delete('/delete/{id}/{type}', [ListController::class, 'delete']);
});


// Admin Dashboard Route
Route::middleware('auth:sanctum')->get('/admin/dashboard', function (Request $request) {
    return response()->json([
        'user' => \Illuminate\Support\Facades\Auth::user(),
        'headers' => $request->headers->all()
    ]);
});

// Test Auth Route
Route::middleware('auth:sanctum')->get('/test-auth', function (Request $request) {
    return response()->json(['message' => 'Authenticated', 'user' => \Illuminate\Support\Facades\Auth::user()]);
});
