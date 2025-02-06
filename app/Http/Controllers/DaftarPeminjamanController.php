<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use App\Models\DaftarPeminjaman;
use App\Models\detailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarPeminjamanController extends Controller
{
    public function index()
{
    $daftarPeminjamans = DaftarPeminjaman::with(['detailPeminjaman' => function ($query) {
        $query->select('pb_id', 'pdb_sts'); // Hanya mengambil pb_id dan pdb_sts
    }])->get();

    return view('daftar-peminjaman.index', compact('daftarPeminjamans'));
}


    public function create()
    {
        $daftarBarangs = DaftarBarang::all();
        return view('daftar-peminjaman.create', compact('daftarBarangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pb_no_siswa' => 'required|string|max:20',
            'pb_nama_siswa' => 'required|string|max:100',
            'pb_tgl' => 'required|date',
            'pb_harus_kembali_tgl' => 'required|date',
            'br_nama' => 'required',
        ]);

        // Tambahkan data tambahan
        $validated['user_id'] = Auth::id();
        $validated['pb_stat'] = 1;
        $validated['created_at'] = now();

        // Generate pb_id baru
        $validated['pb_id'] = DaftarPeminjaman::generatePbId();

        // Simpan data ke tabel `tm_peminjaman`
        $peminjaman = DaftarPeminjaman::create($validated);

        // Simpan detail barang ke tabel `td_peminjaman_barang`
        $detailPeminjaman = [
            'pbd_id' => $validated['pb_id'] . '001', // Contoh format pbd_id (sesuaikan dengan logika no urut)
            'pb_id' => $peminjaman->pb_id,
            'br_kode' => $validated['br_nama'], // `br_nama` sebenarnya kode barang (br_kode)
            'pdb_tanggal' => now(),
            'pdb_sts' => 1,
            'created_at' => now(),
        ];

        detailPeminjaman::create($detailPeminjaman);

        return redirect()->route('daftar-peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $daftarPeminjaman = DaftarPeminjaman::findOrFail($id);
        $detailPeminjaman = DetailPeminjaman::with('barangInventaris')->where('pb_id', $id)->get();
        $daftarBarangs = DaftarBarang::all();

        return view('daftar-peminjaman.edit', compact('daftarPeminjaman', 'detailPeminjaman', 'daftarBarangs'));
    }

    public function update(Request $request, $pb_id)
    {
        $validated = $request->validate([
            'pb_harus_kembali_tgl' => 'required|date',
        ]);

        $peminjaman = DaftarPeminjaman::findOrFail($pb_id);

        $peminjaman->update($validated);

        return redirect()->route('daftar-peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function detail($id)
    {
        $daftarPeminjaman = DaftarPeminjaman::findOrFail($id);
        $detailPeminjaman = DetailPeminjaman::with('barangInventaris')->where('pb_id', $id)->get();
        $daftarBarangs = DaftarBarang::all();

        return view('daftar-peminjaman.detail', compact('daftarPeminjaman', 'detailPeminjaman', 'daftarBarangs'));
    }
}
