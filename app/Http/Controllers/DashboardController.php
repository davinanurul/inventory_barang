<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $username = Auth::user()->user_nama;
        return view('dashboard', compact('username'));
    }
}
