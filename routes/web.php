<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\SalesController;

Route::middleware(['auth'])->group(function () {
    // Product catalog
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

    // Place order
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');

    // Order history
    Route::get('/sales/history', [SalesController::class, 'history'])->name('sales.history');

    // Order status
    Route::get('/sales/status', [SalesController::class, 'status'])->name('sales.status');
});

// Admin-only route (make sure admin middleware is working)
Route::middleware(['auth', 'admin'])->get('/admin/sales-report', [SalesController::class, 'report'])->name('admin.sales.report');
 

use App\Http\Controllers\InventoryController;

Route::middleware(['auth', 'admin'])->prefix('inventory')->group(function () {

    Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');


    Route::get('/add', [InventoryController::class, 'create'])->name('inventory.create');


    Route::post('/store', [InventoryController::class, 'store'])->name('inventory.store');
});
