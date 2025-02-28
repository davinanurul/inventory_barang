<?php

use App\Http\Controllers\DaftarBarangController;
use App\Http\Controllers\DaftarPeminjamanController;
use App\Http\Controllers\DaftarPenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\laporanBarangController;
use App\Http\Controllers\LaporanPengembalianController;
use App\Http\Controllers\LaporanStatusBarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Middleware auth untuk melindungi dashboard dan rute lainnya
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk JenisBarang
    Route::get('jenis-barang', [JenisBarangController::class, 'index'])->name('jenis-barang.index');
    Route::get('jenis-barang/create', [JenisBarangController::class, 'create'])->name('jenis-barang.create');
    Route::post('jenis-barang', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
    Route::get('jenis-barang/{id}/edit', [JenisBarangController::class, 'edit'])->name('jenis-barang.edit');
    Route::put('jenis-barang/{id}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
    Route::delete('jenis-barang/{id}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');

    // Route untuk Daftar Barang
    Route::get('daftar-barang', [DaftarBarangController::class, 'index'])->name('daftar-barang.index');
    Route::get('daftar-barang/create', [DaftarBarangController::class, 'create'])->name('daftar-barang.create');
    Route::post('daftar-barang', [DaftarBarangController::class, 'store'])->name('daftar-barang.store');
    Route::get('daftar-barang/{id}/edit', [DaftarBarangController::class, 'edit'])->name('daftar-barang.edit');
    Route::put('daftar-barang/{br_kode}', [DaftarBarangController::class, 'update'])->name('daftar-barang.update');
    Route::delete('daftar-barang/{br_kode}', [DaftarBarangController::class, 'destroy'])->name('daftar-barang.destroy');
    Route::patch('/daftar-barang/restore/{id}', [DaftarBarangController::class, 'restore'])->name('daftar-barang.restore');

    // Route daftar peminjaman
    Route::get('daftar-peminjaman', [DaftarPeminjamanController::class, 'index'])->name('daftar-peminjaman.index');
    Route::get('daftar-peminjaman/create', [DaftarPeminjamanController::class, 'create'])->name('daftar-peminjaman.create');
    Route::post('daftar-peminjaman', [DaftarPeminjamanController::class, 'store'])->name('daftar-peminjaman.store');
    Route::get('daftar-peminjaman/{id}/edit', [DaftarPeminjamanController::class, 'edit'])->name('daftar-peminjaman.edit');
    Route::put('daftar-peminjaman/{pb_id}', [DaftarPeminjamanController::class, 'update'])->name('daftar-peminjaman.update');
    Route::get('daftar-peminjaman/{id}/detail', [DaftarPeminjamanController::class, 'detail'])->name('daftar-peminjaman.detail');

    // Route Daftar Pengguna
    Route::get('daftar-pengguna', [DaftarPenggunaController::class, 'index'])->name('daftar-pengguna.index');
    Route::get('daftar-pengguna/create', [DaftarPenggunaController::class, 'create'])->name('daftar-pengguna.create');
    Route::post('daftar-pengguna', [DaftarPenggunaController::class, 'store'])->name('daftar-pengguna.store');
    Route::get('/nonaktifkan-akun/{userId}', [DaftarPenggunaController::class, 'nonaktifkanAkun'])->name('user.nonaktifkan');
    Route::get('/aktifkan-akun/{userId}', [DaftarPenggunaController::class, 'aktifkanAkun'])->name('user.aktifkan');

    // Route Pengembalian Barang
    Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('pengembalian/belum-kembali', [PengembalianController::class, 'belumKembali'])->name('pengembalian.belumKembali');

    // Route Laporan
    Route::get('laporan-barang', [laporanBarangController::class, 'laporanDaftarBarang'])->name('laporan-daftar-barang');
    Route::get('laporan-pengembalian', [LaporanPengembalianController::class, 'laporanPengembalianBarang'])->name('laporan-pengembalian-barang');
    Route::get('laporan-status-barang', [LaporanStatusBarangController::class, 'laporanStatusBarang'])->name('laporan-status-barang');

    // Route Siswa
    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('siswa/{siswa_kode}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('siswa/{siswa_kode}/update', [SiswaController::class, 'update'])->name('siswa.update');
});

// Route untuk Login
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
