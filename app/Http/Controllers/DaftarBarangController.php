<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use App\Models\DetailPeminjaman;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarBarangController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'active'); 

        if ($filter === 'deleted') {
            $daftarBarangs = DaftarBarang::onlyTrashed()->get();
        } elseif ($filter === 'all') {
            $daftarBarangs = DaftarBarang::withTrashed()->get();
        } else {
            $daftarBarangs = DaftarBarang::all();
        }

        return view('daftar-barang.index', compact('daftarBarangs', 'filter'));
    }


    public function create()
    {
        $jenisBarang = JenisBarang::all();
        return view('daftar-barang.create', compact('jenisBarang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jns_brg_kode' => 'required',
            'br_nama' => 'required|string|max:255',
            'br_tgl_terima' => 'required|date',
            'br_status' => 'required|in:0,1,2,3',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['br_tgl_entry'] = now();

        // Generate kode barang baru
        $validated['br_kode'] = DaftarBarang::generateKodeBarang();

        // Simpan ke database
        DaftarBarang::create($validated);

        return redirect()->route('daftar-barang.index')->with('success', 'Data Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $daftarBarang = DaftarBarang::findOrFail($id);
        $jenisBarang = JenisBarang::all();
        return view('daftar-barang.edit', compact('daftarBarang', 'jenisBarang'));
    }

    public function update(Request $request, $br_kode)
    {

        $validated = $request->validate([
            'br_nama' => 'required|string|max:255',
            'jns_brg_kode' => 'required',
            'br_tgl_terima' => 'required|date',
            'br_status' => 'required',
        ]);

        $daftarBarang = DaftarBarang::where('br_kode', $br_kode)->firstOrFail();
        $daftarBarang->update([
            'br_nama' => $validated['br_nama'],
            'jns_brg_kode' => $validated['jns_brg_kode'],
            'br_tgl_terima' => $validated['br_tgl_terima'],
            'br_status' => $validated['br_status'],
        ]);

        return redirect()->route('daftar-barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = DaftarBarang::findOrFail($id);

        // Periksa apakah barang ini sedang dipinjam (pdb_sts = 1)
        $sedangDipinjam = DetailPeminjaman::where('br_kode', $barang->br_kode)
            ->where('pdb_sts', 1)
            ->exists();

        if ($sedangDipinjam) {
            return redirect()->back()->with('error', 'Barang sedang dipinjam.');
        }

        // Periksa apakah barang ini pernah dipinjam sebelumnya
        $pernahDipinjam = DetailPeminjaman::where('br_kode', $barang->br_kode)->exists();

        if ($pernahDipinjam) {
            // Jika pernah dipinjam, ubah status menjadi 0 sebelum soft delete
            $barang->br_status = 0;
            $barang->save();

            // Soft delete
            $barang->delete();

            return redirect()->back()->with('success', 'Barang telah dihapus.');
        } else {
            // Jika belum pernah dipinjam, lakukan hard delete
            $barang->forceDelete();

            return redirect()->back()->with('success', 'Barang telah dihapus permanen.');
        }
    }

    public function restore($id)
    {
        $daftarBarang = DaftarBarang::withTrashed()->findOrFail($id);
        $daftarBarang->restore();

        $daftarBarang->br_status = 1;
        $daftarBarang->save();

        return redirect()->route('daftar-barang.index')->with('success', 'Barang berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $daftarBarang = DaftarBarang::withTrashed()->findOrFail($id);
        $daftarBarang->forceDelete();

        return redirect()->route('daftar-barang.index')->with('success', 'Barang berhasil dihapus permanen.');
    }
}
