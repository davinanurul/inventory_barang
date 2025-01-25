<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function create()
    {
        return view('pengembalian-barang.create');
    }
}
