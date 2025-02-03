<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBarangController extends Controller
{
    public function laporanDaftarBarang()
    {
        $laporanBarang = DaftarBarang::with('jenisBarang')
            ->whereNotIn('br_kode', function ($query) {
                $query->select('b.br_kode')
                    ->from('td_peminjaman_barang as b')
                    ->where('b.pdb_sts', 1);
            })
            ->get();

        return view('laporan.laporan-barang', compact('laporanBarang'));
    }
}
