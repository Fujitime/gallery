<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        $latestImage = Gallery::latest()->first();

        return view('home.index', compact('galleries', 'latestImage'));
    }
}
