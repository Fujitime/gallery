<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Album;

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
        $albums = Album::all();
        return view('galleries.create', compact('categories', 'albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'categories' => 'required|array', // Ensure it's an array
            'categories.*' => 'exists:categories,id', // Validate each category ID
            'albums' => 'required|array', // Ensure it's an array
            'albums.*' => 'exists:albums,id', // Validate each album ID
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        $gallery = Gallery::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => $imagePath,
        ]);

        // Attach selected categories and albums to the gallery
        $gallery->categories()->attach($request->input('categories'));
        $gallery->albums()->attach($request->input('albums'));

        return redirect()->route('home.index')->with('success', 'Gallery created successfully.');
    }


    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $categories = Category::all();
        $albums = Album::all();
        return view('galleries.edit', compact('gallery', 'categories', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'categories' => 'required|array', // Ensure it's an array
            'categories.*' => 'exists:categories,id', // Validate each category ID
            'albums' => 'required|array', // Ensure it's an array
            'albums.*' => 'exists:albums,id', // Validate each album ID
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image_path);
            $imagePath = $request->file('image')->store('galleries', 'public');
            $gallery->update(['image_path' => $imagePath]);
        }

        $gallery->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Sync selected categories and albums to the gallery
        $gallery->categories()->sync($request->input('categories'));
        $gallery->albums()->sync($request->input('albums'));

        return redirect()->route('home.index')->with('success', 'Gallery updated successfully.');
    }

    public function show($id)
    {
        $gallery = Gallery::with('comments')->findOrFail($id);
        return view('galleries.show', compact('gallery'));
    }


    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return redirect()->route('home.index')->with('success', 'Gallery has been deleted.');
    }
}
