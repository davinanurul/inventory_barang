<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarBarangController extends Controller
{
    public function index()
    {
        $daftarBarangs = DaftarBarang::all();
        return view('daftar-barang.index', compact('daftarBarangs'));
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
            'br_tgl_terima' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['br_status'] = 0;
        $validated['br_tgl_entry'] = now();

        // Generate kode barang baru
        $validated['br_kode'] = DaftarBarang::generateKodeBarang();

        // Simpan ke database
        DaftarBarang::create($validated);

        return redirect()->route('daftar-barang.index')->with('success', 'Barang berhasil ditambahkan.');
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
        ]);

        $daftarBarang = DaftarBarang::where('br_kode', $br_kode)->firstOrFail();
        $daftarBarang->update([
            'br_nama' => $validated['br_nama'],
            'jns_brg_kode' => $validated['jns_brg_kode'],
        ]);

        return redirect()->route('daftar-barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $daftarBarang = DaftarBarang::findOrFail($id);
        $daftarBarang->delete();

        return redirect()->route('daftar-barang.index')->with('success', 'Jenis Barang berhasil dihapus');
    }
}
