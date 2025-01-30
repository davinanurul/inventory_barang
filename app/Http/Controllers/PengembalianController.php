<?php

namespace App\Http\Controllers;

use App\Models\DaftarPeminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function create()
    {
        $peminjaman = DaftarPeminjaman::all();
        $barangPinjaman = DetailPeminjaman::with('barangInventaris')
            ->get();

        return view('pengembalian.create', compact('peminjaman', 'barangPinjaman'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pb_id' => 'required|exists:tm_peminjaman,pb_id',
            'kembali_tgl' => 'required|date',
            'kembali_sts' => 'required|in:0,1',
        ]);

        $kembali_id = Pengembalian::generateKembaliId();

        Pengembalian::create([
            'kembali_id' => $kembali_id,
            'pb_id' => $request->pb_id,
            'user_id' => auth()->id(),
            'kembali_tgl' => $request->kembali_tgl,
            'kembali_sts' => $request->kembali_sts,
        ]);

        // Update status barang di tabel td_peminjaman_barang menjadi 0 (dikembalikan)
        DB::table('td_peminjaman_barang')
            ->where('pb_id', $request->pb_id)
            ->update(['pdb_sts' => 0]);

        return redirect()->route('pengembalian.create')->with('success', 'Barang berhasil dikembalikan.');
    }

    public function belumKembali()
    {
        $barangBelumKembali = DetailPeminjaman::with('barangInventaris')
            ->where('pdb_sts', 1)
            ->get();

        return view('pengembalian.belum-kembali', compact('barangBelumKembali'));
    }
}
