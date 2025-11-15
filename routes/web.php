<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FinnhubController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    // return Inertia::render('Welcome');
    return Inertia::render('Home');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/finntest', [TestController::class, 'test']);
    Route::get('/bitcoin-price', [FinnhubController::class, 'getBitcoinPrice'])->name('bitcoin.price');
    Route::get('/notifications', function () {
        return Inertia::render('Notifications');
    })->name('notifications');
    Route::get('/calendar', function () {
        return Inertia::render('Calendar');
    })->name('calendar');
    Route::get('/brand-examples', function () {
        return Inertia::render('BrandExamples');
    })->name('brand-examples');
});

Route::get('test', [TestController::class, 'test']);
Route::get('test/success', [TestController::class, 'testSuccess']);
Route::get('test/error', [TestController::class, 'testError']);
Route::get('test/info', [TestController::class, 'testInfo']);
Route::get('test/warning', [TestController::class, 'testWarning']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


Route::middleware(['auth:sanctum', RoleMiddleware::class . ':admin'])->group(function () {
    // Example admin-only route
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Route::get('/admin/dashboard', function () {
    //     return Inertia::render('Admin/Dashboard');
    // })->name('admin.dashboard');
});
