<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Auth::user()->albums()->latest()->get();
        return view('dashboard.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('dashboard.albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:private,public',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan cover image jika diunggah
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('cover_images', 'public');
        } else {
            $imagePath = null; // Atau sesuaikan dengan path placeholder jika tidak ada gambar yang diunggah
        }

        $album = Auth::user()->albums()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'cover_image' => $imagePath,
        ]);

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }


    public function show($id)
    {
        try {
            $album = Album::findOrFail($id);
            return view('dashboard.albums.show', compact('album'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('albums.index')->with('error', 'Album not found.');
        }
    }

    public function edit(Album $album)
    {
        $galleries = Gallery::all();
        return view('dashboard.albums.edit', compact('album', 'galleries'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:private,public',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update atribut album
        $album->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // Tambahkan gambar ke album jika dipilih dari galeri
        if ($request->has('gallery_ids')) {
            $album->galleries()->syncWithoutDetaching($request->gallery_ids);
        }

        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
}
