<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioOwnerController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TestimonialController;

// -----------------------
// Public Authentication (handled by UserController now)
// -----------------------
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// -----------------------
// Protected Routes
// -----------------------
Route::middleware(['auth:sanctum'])->group(function () {

    // Optional: Add logout and update-profile here once implemented
    // Route::post('/logout', [UserController::class, 'logout']);
    // Route::put('/profile', [UserController::class, 'updateProfile']);

    // -----------------------
    // Employer Routes
    // -----------------------
    Route::middleware('role:employer')->prefix('employer')->group(function () {
        Route::get('/dashboard', [EmployerController::class, 'dashboard']);
        Route::post('/update-profile', [EmployerController::class, 'updateProfile']);
    });

    // -----------------------
    // Portfolio Owner Routes
    // -----------------------
    Route::middleware('role:portfolio_owner')->prefix('portfolio')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('portfolios.index');
        Route::get('/create', [PortfolioController::class, 'create']);
        Route::post('/', [PortfolioController::class, 'store'])->name('portfolios.store');
        Route::get('/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
        Route::put('/{id}', [PortfolioController::class, 'update'])->name('portfolios.update');
        Route::delete('/{id}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
    });

    // -----------------------
    // Portfolio Owner Profile CRUD
    // -----------------------
    Route::prefix('portfolio-owners')->group(function () {
        Route::get('/', [PortfolioOwnerController::class, 'index']);
        Route::post('/', [PortfolioOwnerController::class, 'store']);
        // Add update/delete as needed
    });

    // -----------------------
    // Students & Employees CRUD + Search
    // -----------------------
    Route::get('/list/employees', [ListController::class, 'getEmployees']);
    Route::get('/list/students', [ListController::class, 'getStudents']);

    Route::get('/search', [ListController::class, 'search']);
    Route::post('/create/{type}', [ListController::class, 'create']);
    Route::get('/{type}/{id}', [ListController::class, 'show']);
    Route::put('/{type}/{id}', [ListController::class, 'update']);
    Route::delete('/{type}/{id}', [ListController::class, 'delete']);

    // -----------------------
    // Testimonials CRUD
    // -----------------------
    Route::get('/testimonials', [TestimonialController::class, 'index']);
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show']);
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update']);
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy']);
});
