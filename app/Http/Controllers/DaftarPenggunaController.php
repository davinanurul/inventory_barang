<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarPenggunaController extends Controller
{
    public function index()
    {
        return view('daftar-pengguna.index');
    }
}
