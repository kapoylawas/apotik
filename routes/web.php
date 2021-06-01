<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['role:owner']], function() {
    // Route::get('getSupplier', [SupplierController::class, 'getSupplier'])->name('supplier.getSupplier');
    Route::get('supplier.index', [SupplierController::class, 'index'])->name('supplier.index');
    Route::post('supplier.store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::post('supplier.edits', [SupplierController::class, 'edits'])->name('supplier.edits');
    Route::post('supplier.updates', [SupplierController::class, 'updates'])->name('supplier.updates');
    Route::post('supplier.hapus', [SupplierController::class, 'hapus'])->name('supplier.hapus');
});

require __DIR__.'/auth.php';
