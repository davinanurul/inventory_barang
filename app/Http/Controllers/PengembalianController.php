<?php

namespace App\Http\Controllers;

use App\Models\DaftarPeminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman')
            ->orderByDesc('kembali_id')
            ->get();

        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create(Request $request)
    {
        $selectedPbId = $request->pb_id;
        $peminjaman = DaftarPeminjaman::with('detailPeminjaman.barangInventaris')
            ->where('pb_id', $selectedPbId)
            ->first();
        return view('pengembalian.create', compact('peminjaman', 'selectedPbId'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pb_id' => 'required|exists:tm_peminjaman,pb_id',
            'kembali_sts' => 'required|in:0,1',
        ]);

        $kembali_id = Pengembalian::generateKembaliId();
        $kembali_tgl = now();

        // Simpan data pengembalian ke tabel `tm_pengembalian`
        Pengembalian::create([
            'kembali_id' => $kembali_id,
            'pb_id' => $request->pb_id,
            'user_id' => auth()->id(),
            'kembali_tgl' => $kembali_tgl,
            'kembali_sts' => $request->kembali_sts,
        ]);

        DB::table('td_peminjaman_barang')
            ->where('pb_id', $request->pb_id)
            ->update(['pdb_sts' => 0]);

        DB::table('tm_peminjaman')
            ->where('pb_id', $request->pb_id)
            ->update(['pb_stat' => 0]);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil.');
    }


    public function belumKembali()
    {
        $barangBelumKembali = DetailPeminjaman::with('barangInventaris')
            ->where('pdb_sts', 1)
            ->get();

        return view('pengembalian.belum-kembali', compact('barangBelumKembali'));
    }
}
