<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class DaftarBarangController extends Controller
{
    public function index()
    {
        return view('daftar-barang.index');
    }

    public function create()
    {
        $jenisBarang = JenisBarang::all();
        return view('daftar-barang.create', compact('jenisBarang'));
    }
}
