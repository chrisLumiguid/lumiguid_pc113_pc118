<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;
use App\Models\Student;
use App\Models\Employee;


Route::get('/user', function (Request $request){
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create-user', [UserController::class, 'create']);


 Route::post('/login', [UserController::class, 'login']);   

Route::middleware('auth:sanctum')->group(function () { 
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/profile', [UserController::class, 'profile']);

    Route::prefix('admin')->group(function () {
        Route::get('/employeeList', [UserController::class, 'employeeList'])->middleware('admin');
        Route::get('/find', [ListController::class, 'searchEmployees'])->middleware('admin');
        Route::get('/employee',[ListController::class, 'employee'])->middleware('admin');
    });

    Route::get('/student', [ListController::class, 'index']);
    Route::get('/limit', [ListController::class, 'limit']);
    Route::post('/create', [ListController::class, 'create']);
    Route::delete('/delete/{id}/{type}', [ListController::class, 'delete']);
    Route::put('/update/{id}', [ListController::class, 'update']);
});




