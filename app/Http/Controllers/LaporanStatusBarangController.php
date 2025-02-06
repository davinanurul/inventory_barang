<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use Illuminate\Http\Request;

class LaporanStatusBarangController extends Controller
{
    public function laporanStatusBarang(Request $request)
    {
        $status = $request->input('status');
        $query = DaftarBarang::query();

        if ($status) {
            $query->where('tm_barang_inventaris.br_status', $status);
        }

        $laporanStatusBarang = $query->get();

        return view('laporan.status-barang', compact('laporanStatusBarang'));
    }
}
