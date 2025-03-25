<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/

// Admin Dashboard
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Admin Orders
Route::group(['prefix' => 'admin/orders', 'as' => 'admin.orders.'], function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('index');
    Route::get('/report', [AdminOrderController::class, 'report'])->name('report');
    Route::get('/{id}', [AdminOrderController::class, 'show'])->name('show');
    Route::patch('/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('update-status');
});

// Note: Add these routes to your RouteServiceProvider or include this file in your web.php
