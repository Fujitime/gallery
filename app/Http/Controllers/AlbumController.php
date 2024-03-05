<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $status = $request->input('status', 'private');

            $imagePath = null;
            if ($request->hasFile('cover_image')) {
                $imagePath = $request->file('cover_image')->store('cover_images', 'public');
            }

            $album = Auth::user()->albums()->create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $status,
                'cover_image' => $imagePath,
            ]);

            return redirect()->route('albums.index')->with('success', 'Album created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('albums.index')->with('error', 'Failed to create album.');
        }
    }

    public function show($id)
    {
        try {
            $album = Album::findOrFail($id);
            return view('dashboard.albums.show', compact('album'));
        } catch (\Exception $e) {
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
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'status' => 'nullable|in:private,public',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $status = $request->input('status', $album->status);

            $imagePath = $album->cover_image;
            if ($request->hasFile('cover_image')) {
                $imagePath = $request->file('cover_image')->store('cover_images', 'public');
                if ($album->cover_image) {
                    Storage::disk('public')->delete($album->cover_image);
                }
            }

            $album->title = $request->input('title', $album->title);
            $album->description = $request->input('description', $album->description);
            $album->status = $status;
            $album->cover_image = $imagePath;
            $album->save();

            if ($request->has('gallery_ids')) {
                $album->galleries()->sync($request->gallery_ids);
            } else {
                $album->galleries()->detach();
            }

            return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('albums.index')->with('error', 'Failed to update album.');
        }
    }

    public function destroy(Album $album)
    {
        try {
            $album->delete();
            return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('albums.index')->with('error', 'Failed to delete album.');
        }
    }

    public function guestIndex()
    {
        $albums = Album::where('status', 'public')->latest()->get();
        return view('guest.albums', compact('albums'));
    }

}
