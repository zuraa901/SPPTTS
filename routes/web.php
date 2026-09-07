<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\DashboardBkController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('pelanggaran')->name('pelanggaran.')->group(function () {
    Route::get('/', [PelanggaranController::class, 'index'])->name('index');
    Route::get('/create', [PelanggaranController::class, 'create'])->name('create');
    Route::post('/', [PelanggaranController::class, 'store'])->name('store');
    Route::get('/{id}', [PelanggaranController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PelanggaranController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PelanggaranController::class, 'update'])->name('update');
    Route::delete('/{id}', [PelanggaranController::class, 'destroy'])->name('destroy');
});

Route::get('/dashboard-bk', [DashboardBkController::class, 'index'])->name('dashboard.bk');
