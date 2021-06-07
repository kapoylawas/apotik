<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StockObatController;

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

Route::group(['middleware' => ['role:owner']], function () {
    // Route::get('getSupplier', [SupplierController::class, 'getSupplier'])->name('supplier.getSupplier');
    Route::get('supplier.index', [SupplierController::class, 'index'])->name('supplier.index');
    Route::post('supplier.store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::post('supplier.edits', [SupplierController::class, 'edits'])->name('supplier.edits');
    Route::post('supplier.updates', [SupplierController::class, 'updates'])->name('supplier.updates');
    Route::post('supplier.hapus', [SupplierController::class, 'hapus'])->name('supplier.hapus');

    //route katalog obat
    Route::get('obat.index', [ObatController::class, 'index'])->name('obat.index');
    Route::post('obat.store', [ObatController::class, 'store'])->name('obat.store');
    Route::post('obat.edits', [ObatController::class, 'edits'])->name('obat.edits');
    Route::post('obat.updates', [ObatController::class, 'updates'])->name('obat.updates');
    Route::post('obat.hapus', [ObatController::class, 'hapus'])->name('obat.hapus');

    //route Stock obat
    Route::get('stock.index', [StockObatController::class, 'index'])->name('stock.index');
    Route::post('stock.store', [StockObatController::class, 'store'])->name('stock.store');
    Route::post('stock.edits', [StockObatController::class, 'edits'])->name('stock.edits');
    Route::post('stock.updates', [StockObatController::class, 'updates'])->name('stock.updates');
    Route::post('stock.hapus', [StockObatController::class, 'hapus'])->name('stock.hapus');
    Route::post('getObat', [StockObatController::class, 'getObat'])->name('getObat');

    //route Stock penjualan
    Route::get('penjualan.index', [PenjualanController::class, 'index'])->name('penjualan.index');
    // Route::post('getDataObat', [StockObatController::class, 'getDataObat'])->name('getDataObat');
});

require __DIR__ . '/auth.php';
