<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth

class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id()); // Tambahkan titik koma
        $galleries = Gallery::all();
        $latestImage = Gallery::latest()->first();

        return view('home.index', compact('galleries', 'latestImage', 'user'));
    }
}
