<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Perlu diimpor karena menggunakan Auth
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id()); // Mengambil data pengguna yang sedang login

        return view('dashboard.dashboard', compact('user')); // Tidak perlu tanda ')' tambahan di sini
    }
}
