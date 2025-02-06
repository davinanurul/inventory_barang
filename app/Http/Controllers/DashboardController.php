<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use App\Models\DaftarPeminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $username = Auth::user()->user_nama;
        $jumlahBarang = DaftarBarang::count();
        $jumlahPeminjaman = DaftarPeminjaman::count();
        $jumlahPengembalian = Pengembalian::count();

        $chartData = [];

        for ($i = 9; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartData[] = [
                'date' => $date,
                'peminjaman' => DaftarPeminjaman::whereDate('created_at', $date)->count(),
                'pengembalian' => Pengembalian::whereDate('created_at', $date)->count()
            ];
        }

        return view('dashboard', compact(
            'username',
            'jumlahBarang',
            'jumlahPeminjaman',
            'jumlahPengembalian',
            'chartData'
        ));
    }
}
