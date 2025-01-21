<?php

use App\Http\Controllers\DaftarBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk JenisBarang
Route::get('jenis-barang', [JenisBarangController::class, 'index'])->name('jenis-barang.index');
Route::get('jenis-barang/create', [JenisBarangController::class, 'create'])->name('jenis-barang.create');
Route::post('jenis-barang', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
Route::get('jenis-barang/{id}/edit', [JenisBarangController::class, 'edit'])->name('jenis-barang.edit');
Route::put('jenis-barang/{id}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
Route::delete('jenis-barang/{id}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');

// Route Daftar Barang
Route::get('daftar-barang', [DaftarBarangController::class, 'index'])->name('daftar-barang.index');
Route::get('daftar-barang/create', [DaftarBarangController::class, 'create'])->name('daftar-barang.create');
Route::post('daftar-barang', [DaftarBarangController::class, 'store'])->name('daftar-barang.store');
Route::get('daftar-barang/{id}/edit', [DaftarBarangController::class, 'edit'])->name('daftar-barang.edit');
Route::put('daftar-barang/{br_kode}', [DaftarBarangController::class, 'update'])->name('daftar-barang.update'); 
Route::delete('daftar-barang/{br_kode}', [DaftarBarangController::class, 'destroy'])->name('daftar-barang.destroy');