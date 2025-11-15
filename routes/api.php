<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/notifications', [NotificationController::class, 'index']);
    
    // Calendar routes
    Route::get('/calendar', [CalendarController::class, 'index']);
    Route::get('/calendar/month', [CalendarController::class, 'getMonthData']);
    Route::post('/calendar/skip', [CalendarController::class, 'skipDelivery']);
    Route::post('/calendar/cancel', [CalendarController::class, 'cancelService']);
});


Route::middleware(['auth:sanctum', 'role:staff'])->group(function () {
    // Example staff-only API route
    Route::get('/staff/tasks', function () {
        return response()->json(['tasks' => 'All staff tasks']);
    });
});
