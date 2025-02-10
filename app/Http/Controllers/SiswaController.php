<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $daftarSiswa = Siswa::all();
        return view('siswa.index', compact('daftarSiswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_kode' => 'required|max:10',
            'siswa_nama' => 'required',
            'siswa_kelas' => 'required'
        ]);

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($siswa_kode)
    {
        $daftarSiswa = Siswa::where('siswa_kode', $siswa_kode)->firstOrFail();
        return view('siswa.edit', compact('daftarSiswa'));
    }

    public function update(Request $request, $siswa_kode)
    {
        $validated = $request->validate([
            'siswa_kode' => 'required|max:10',
            'siswa_nama' => 'required',
            'siswa_kelas' => 'required'
        ]);

        $daftarSiswa = Siswa::where('siswa_kode', $siswa_kode)->firstOrFail();
        $daftarSiswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate');
    }
}
