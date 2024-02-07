<?php

namespace App\Http\Controllers;
use App\Models\Album;
use Illuminate\Http\Request;
class AlbumController extends Controller
{
    public function index()
    {
        $albums = auth()->user()->albums ?? [];
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        auth()->user()->albums()->create($request->all());

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    // Tambahan fungsi-fungsi lainnya
}
