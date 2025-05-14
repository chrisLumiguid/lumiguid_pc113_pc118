    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\EmployerController;
    use App\Http\Controllers\PortfolioController;
    use App\Http\Controllers\PortfolioOwnerController;
    use App\Http\Controllers\ListController;
    use App\Http\Controllers\TestimonialController;
    use App\Http\Controllers\PortfolioReportController;

    // -----------------------------------------
    // 🌐 Public Routes (No Authentication)
    // -----------------------------------------

    // Authentication
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

    // Public Lists
    Route::get('/employees', [ListController::class, 'getEmployees']);
    Route::get('/students', [ListController::class, 'getStudents']);
    Route::get('/search', [ListController::class, 'search']);
    Route::post('/create/{type}', [ListController::class, 'create']);
    Route::get('/{type}/{id}', [ListController::class, 'show']);
    Route::put('/update/{type}/{id}', [ListController::class, 'update']);
    Route::delete('/delete/{type}/{id}', [ListController::class, 'delete']);

    // Public Testimonials
    Route::get('/testimonials', [TestimonialController::class, 'index']);
    Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show']);

// -----------------------------------------
// 🔐 Protected Routes (Authentication Required)
// -----------------------------------------
Route::middleware(['auth:sanctum'])->group(function () {

        // User Profile & Logout
        Route::post('/logout', [UserController::class, 'logout']);
        Route::put('/profile', [UserController::class, 'updateProfile']);
        Route::post('/portfolio_owner/complete-profile', [PortfolioOwnerController::class, 'completeProfile']);

        // 🌟 Authenticated Testimonials CRUD
        Route::post('/testimonials', [TestimonialController::class, 'store']);
        Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update']);
        Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy']);

    // -----------------------------------------
    // 🏢 Employer Only Routes
    // -----------------------------------------
    Route::middleware('role:employer')->prefix('employer')->group(function () {
        Route::get('/dashboard', [EmployerController::class, 'dashboard']);
        Route::post('/update-profile', [EmployerController::class, 'updateProfile']);
    });

    // -----------------------------------------
    // 🧑‍💼 Portfolio Owner Only Routes
    // -----------------------------------------
    Route::middleware('role:portfolio_owner')->prefix('portfolio')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('portfolios.index');
        Route::get('/create', [PortfolioController::class, 'create']);
        Route::post('/', [PortfolioController::class, 'store'])->name('portfolios.store');
        Route::get('/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
        Route::put('/{id}', [PortfolioController::class, 'update'])->name('portfolios.update');
        Route::delete('/{id}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');

        // Portfolio Reports
        Route::prefix('reports')->group(function () {
            Route::get('/', [PortfolioReportController::class, 'index'])->name('reports.index');
            Route::get('/create', [PortfolioReportController::class, 'create'])->name('reports.create');
            Route::post('/', [PortfolioReportController::class, 'store'])->name('reports.store');
            Route::get('/{report}', [PortfolioReportController::class, 'show'])->name('reports.show');
            Route::get('/{report}/edit', [PortfolioReportController::class, 'edit'])->name('reports.edit');
            Route::put('/{report}', [PortfolioReportController::class, 'update'])->name('reports.update');
            Route::delete('/{report}', [PortfolioReportController::class, 'destroy'])->name('reports.destroy');
        });
    });

    // -----------------------------------------
    // 🛡️ Admin Only Routes
    // -----------------------------------------
    Route::middleware('role:admin')->prefix('admin')->group(function () {

        // User Management
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        // Portfolio Management
        Route::get('/portfolios', [PortfolioController::class, 'index']);
        Route::get('/portfolios/{id}', [PortfolioController::class, 'show']);
        Route::post('/portfolios', [PortfolioController::class, 'store']);
        Route::put('/portfolios/{id}', [PortfolioController::class, 'update']);
        Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy']);

        // Employer Management
        Route::get('/employers', [EmployerController::class, 'index']);
        Route::get('/employers/{id}', [EmployerController::class, 'show']);
        Route::post('/employers', [EmployerController::class, 'store']);
        Route::put('/employers/{id}', [EmployerController::class, 'update']);
        Route::delete('/employers/{id}', [EmployerController::class, 'destroy']);

        // Portfolio Owner Management
        Route::get('/portfolio-owners', [PortfolioOwnerController::class, 'index']);
        Route::get('/portfolio-owners/{id}', [PortfolioOwnerController::class, 'show']);
        Route::post('/portfolio-owners', [PortfolioOwnerController::class, 'store']);
        Route::put('/portfolio-owners/{id}', [PortfolioOwnerController::class, 'update']);
        Route::delete('/portfolio-owners/{id}', [PortfolioOwnerController::class, 'destroy']);

        // Reports Management
        Route::get('/reports', [PortfolioReportController::class, 'index']);
        Route::get('/reports/create', [PortfolioReportController::class, 'create']);
        Route::post('/reports', [PortfolioReportController::class, 'store']);
        Route::get('/reports/{report}', [PortfolioReportController::class, 'show']);
        Route::get('/reports/{report}/edit', [PortfolioReportController::class, 'edit']);
        Route::put('/reports/{report}', [PortfolioReportController::class, 'update']);
        Route::delete('/reports/{report}', [PortfolioReportController::class, 'destroy']);

        // Testimonial Management
        Route::get('/testimonials', [TestimonialController::class, 'index']);
        Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show']);
        Route::post('/testimonials', [TestimonialController::class, 'store']);
        Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update']);
        Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy']);
    });
});
