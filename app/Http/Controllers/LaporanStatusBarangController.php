<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use Illuminate\Http\Request;

class LaporanStatusBarangController extends Controller
{
    public function laporanStatusBarang()
    {
        $laporanStatusBarang = DaftarBarang::all();
        return view('laporan.status-barang', compact('laporanStatusBarang'));
    }
}
