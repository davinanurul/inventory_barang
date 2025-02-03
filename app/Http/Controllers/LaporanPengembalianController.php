<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;

class LaporanPengembalianController extends Controller
{
    public function laporanPengembalianBarang()
    {
        $laporanPengembalian = Pengembalian::with('user')->get();
        return view('laporan.laporan-pengembalian', compact('laporanPengembalian'));
    }
}
