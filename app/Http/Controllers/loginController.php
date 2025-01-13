<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input user
        $request->validate([
            'user_nama' => 'required|string',
            'user_pass' => 'required|string',
        ]);

        // Cari user berdasarkan user_nama
        $user = User::where('user_nama', $request->user_nama)->first();

        // Verifikasi apakah user ada dan cocokkan password dengan MD5
        if (!$user || md5($request->user_pass) != $user->user_pass) {
            return response()->json([
                'message' => 'Username atau password salah'
            ], 401);
        }

        // Jika user ditemukan dan password cocok, login user
        Auth::login($user);

        // Arahkan user ke halaman welcome setelah berhasil login
        return redirect()->route('welcome');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}