<?php

use App\Http\Controllers\daftarBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('daftar-barang', daftarBarangController::class);

// Route untuk JenisBarang
Route::get('jenis-barang', [JenisBarangController::class, 'index'])->name('jenis-barang.index');
Route::get('jenis-barang/create', [JenisBarangController::class, 'create'])->name('jenis-barang.create');
Route::post('jenis-barang', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
Route::get('jenis-barang/{id}/edit', [JenisBarangController::class, 'edit'])->name('jenis-barang.edit');
Route::put('jenis-barang/{id}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
Route::delete('jenis-barang/{id}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');