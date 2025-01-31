<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Transactions
    Route::resource('transactions', TransactionController::class);
    Route::get('transactions/{transaction}/print', [TransactionController::class, 'printReceipt'])
        ->name('transactions.print');
    Route::get('reports', [TransactionController::class, 'report'])
        ->name('transactions.report');

    // Users (Admin Only)
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

require __DIR__ . '/auth.php';
