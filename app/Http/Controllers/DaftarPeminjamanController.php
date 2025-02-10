<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use App\Models\DaftarPeminjaman;
use App\Models\detailPeminjaman;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarPeminjamanController extends Controller
{
    public function index()
    {
        $daftarPeminjamans = DaftarPeminjaman::with(['detailPeminjaman' => function ($query) {
            $query->select('pb_id', 'pdb_sts');
        }])
            ->leftJoin('td_peminjaman_barang', 'tm_peminjaman.pb_id', '=', 'td_peminjaman_barang.pb_id')
            ->orderByRaw('COALESCE(td_peminjaman_barang.pdb_sts, 0) DESC') // Prioritas pdb_sts == 1
            ->orderBy('tm_peminjaman.pb_tgl', 'DESC') // Urutkan dari terbaru ke terlama
            ->select('tm_peminjaman.*')
            ->get();

        return view('daftar-peminjaman.index', compact('daftarPeminjamans'));
    }

    public function create()
    {
        $daftarSiswa = Siswa::all();
        $barang = DaftarBarang::where('br_status', 1) // Ambil daftar barang yang memiliki br_status = 1
            ->whereDoesntHave('peminjamanBarang', function ($query) {
                $query->where('pdb_sts', 1); // Barang tidak muncul jika sedang dipinjam (status peminjaman = 1)
            })
            ->get();

        return view('daftar-peminjaman.create', compact('daftarSiswa', 'barang'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'pb_no_siswa' => 'required|string|max:20',
            'pb_nama_siswa' => 'required|string|max:100',
            'pb_harus_kembali_tgl' => 'required|date',
            'data_peminjaman' => 'required|array',
            'data_peminjaman.*.br_kode' => 'required|string|max:20',
        ]);

        // Tambahkan data tambahan
        $validated['user_id'] = Auth::id();
        $validated['pb_stat'] = 1;
        $validated['created_at'] = now();
        $validated['pb_tgl'] = now();

        // Generate pb_id baru
        $validated['pb_id'] = DaftarPeminjaman::generatePbId();

        // Simpan data ke tabel `tm_peminjaman`
        $peminjaman = DaftarPeminjaman::create([
            'pb_id' => $validated['pb_id'],
            'pb_no_siswa' => $validated['pb_no_siswa'],
            'pb_nama_siswa' => $validated['pb_nama_siswa'],
            'pb_harus_kembali_tgl' => $validated['pb_harus_kembali_tgl'],
            'pb_stat' => 1,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'pb_tgl' => now(),
        ]);

        // Simpan detail barang ke tabel `td_peminjaman_barang`
        foreach ($validated['data_peminjaman'] as $index => $item) {
            DetailPeminjaman::create([
                'pbd_id' => $validated['pb_id'] . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // Contoh format pbd_id (pb_id + nomor urut)
                'pb_id' => $peminjaman->pb_id,
                'br_kode' => $item['br_kode'],
                'pdb_tanggal' => now(),
                'pdb_sts' => 1,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('daftar-peminjaman.index')->with('success', 'Data peminjaman berhasil dibuat.');
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
