<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use App\Models\Category;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('category')->get();

        return view('home.index', compact('galleries'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('home.index')->with('success', 'Galeri berhasil ditambahkan.');
    }
}
