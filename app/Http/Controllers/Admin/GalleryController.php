<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\User;
use App\Models\Album;
use Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('category')->get();
        $user = User::find(Auth::id()); // Mengambil data pengguna yang sedang login
        return view('home.index', compact('galleries', 'user')); // Mengirimkan data pengguna ke tampilan
    }
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('galleries.show', compact('gallery'));
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
            'user_id' => Auth::id(), // Assign the current user's ID
        ]);

        // Attach selected categories and albums to the gallery
        $gallery->categories()->attach($request->input('categories'));
        $gallery->albums()->attach($request->input('albums'));

        return redirect()->route('home.index')->with('success', 'Gallery created successfully.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Check if the user is authorized to edit the gallery
        if (Auth::user()->role === 'admin' || $gallery->user_id === Auth::id()) {
            $categories = Category::all();
            $albums = Album::all();
            return view('galleries.edit', compact('gallery', 'categories', 'albums'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        // Check if the user is authorized to update the gallery
        if (Auth::user()->role === 'admin' || $gallery->user_id === Auth::id()) {
            $request->validate([
                'title' => 'required',
                'description' => 'nullable',
                'categories' => 'required|array', // Ensure it's an array
                'categories.*' => 'exists:categories,id', // Validate each category ID
                'albums' => 'required|array', // Ensure it's an array
                'albums.*' => 'exists:albums,id', // Validate each album ID
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update logic
            // Handle image upload if provided
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($gallery->image_path);
                $imagePath = $request->file('image')->store('galleries', 'public');
                $gallery->update(['image_path' => $imagePath]);
            }

            // Update gallery details
            $gallery->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            // Sync selected categories and albums to the gallery
            $gallery->categories()->sync($request->input('categories'));
            $gallery->albums()->sync($request->input('albums'));

            return redirect()->route('home.index')->with('success', 'Gallery updated successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Check if the user is authorized to delete the gallery
        if (Auth::user()->role === 'admin' || $gallery->user_id === Auth::id()) {
            try {
                // Deletion logic
                // Manually detach related categories and albums
                $gallery->categories()->detach();
                $gallery->albums()->detach();

                // Delete the gallery
                Storage::disk('public')->delete($gallery->image_path);
                $gallery->delete();

                return redirect()->route('home.index')->with('success', 'Gallery has been deleted.');
            } catch (\Exception $e) {
                return redirect()->route('home.index')->with('error', 'Failed to delete gallery.');
            }
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

}
