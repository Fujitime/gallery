<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\User;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Gallery::query();
            $categories = Category::all();

            // Filter by search keyword
            if ($request->has('search') && $request->filled('search')) {
                $search = $request->input('search');
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            }

            // Filter by category
            if ($request->has('category') && $request->filled('category')) {
                $categoryId = $request->input('category');
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('id', $categoryId);
                });
            }

            $galleries = $query->with('categories')->get();
            $user = User::findOrFail(Auth::id());

            return view('home.index', compact('galleries', 'user', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching galleries.');
        }
    }


    public function action(Request $request)
    {
        try {
            // Dapatkan pengguna yang saat ini masuk
            $user = Auth::user();

            // Ambil nilai filter dari permintaan
            $filterBy = $request->input('filter_by');

            // Inisialisasi query untuk galeri
            $galleriesQuery = Gallery::query();

            // Jika pengguna adalah admin, tidak perlu filter
            if ($user->role === 'admin') {
                // Ambil semua galeri
                $galleriesQuery = Gallery::query();
            } else {
                // Jika pengguna bukan admin, filter galeri berdasarkan pengguna saat ini
                $galleriesQuery->where('user_id', $user->id);
            }

            // Jika ada filter berdasarkan jenis galeri, terapkan filter
            if ($filterBy === 'public') {
                $galleriesQuery->where('user_id', '!=', $user->id);
            } elseif ($filterBy === 'own') {
                $galleriesQuery->where('user_id', $user->id);
            }

            // Tambahkan orderBy untuk mengurutkan berdasarkan tanggal terbaru
            $galleriesQuery->orderBy('created_at', 'desc');

            // Ambil data galeri yang telah difilter
            $galleries = $galleriesQuery->with('categories')->paginate(5);

            // Kembalikan tampilan bersama dengan data galeri dan pengguna
            return view('dashboard.galleries.action', compact('galleries', 'user'));
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->with('error', 'An error occurred while fetching galleries.');
        }
    }

    public function show($id)
    {
        try {
            // Cari galeri berdasarkan ID
            $gallery = Gallery::findOrFail($id);

            // Hitung total galeri yang diunggah oleh pengguna
            $totalGalleries = $gallery->user->galleries()->count();

            // Hitung total komentar pada galeri ini
            $totalComments = $gallery->comments()->count();

            // Kembalikan tampilan dengan data galeri dan pengguna
            return view('dashboard.galleries.show', compact('gallery', 'totalGalleries', 'totalComments'));
        } catch (\Exception $e) {
            // Tangani kesalahan dan kembalikan pesan kesalahan
            return redirect()->route('home.index')->with('error', 'Failed to show gallery: ' . $e->getMessage());
        }
    }



    public function edit($id)
{
    try {
        $gallery = Gallery::findOrFail($id);

        // Check if the user is authorized to edit the gallery
        if (Auth::user()->role === 'admin' || $gallery->user_id === Auth::id()) {
            $categories = Category::all();
            $albums = Album::all();
            return view('dashboard.galleries.edit', compact('gallery', 'categories', 'albums'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    } catch (ModelNotFoundException $e) {
        return redirect()->route('home.index')->with('error', 'Gallery not found.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while fetching gallery for editing.');
    }
}

public function create()
{
    try {
        $categories = Category::all();
        $albums = Album::all();
        return view('dashboard.galleries.create', compact('categories', 'albums'));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while loading create gallery page.');
    }
}

public function store(Request $request)
{
    try {
    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'categories' => 'nullable|array', // Ensure it's an array and can be nullable
        'categories.*' => 'nullable|exists:categories,id', // Validate each category ID, can be nullable
        'albums' => 'nullable|array', // Ensure it's an array and can be nullable
        'albums.*' => 'nullable|exists:albums,id', // Validate each album ID, can be nullable
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
    ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('galleries', 'public');

        // Create new gallery
        $gallery = new Gallery();
        $gallery->user_id = Auth::id();
        $gallery->title = $request->input('title');
        $gallery->description = $request->input('description');
        $gallery->image_path = $imagePath;
        $gallery->save();

        // Attach categories and albums to the gallery
        $gallery->categories()->attach($request->input('categories'));
        $gallery->albums()->attach($request->input('albums'));

        return redirect()->route('home.index')->with('success', 'Gallery created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to create gallery: ' . $e->getMessage());
    }
}

public function update(Request $request, $id)
{
    try {
        $gallery = Gallery::findOrFail($id);

        // Check if the user is authorized to update the gallery
        if (Auth::user()->role === 'admin' || $gallery->user_id === Auth::id()) {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'categories' => 'nullable|array', // Ensure it's an array and can be nullable
                'categories.*' => 'nullable|exists:categories,id', // Validate each category ID, can be nullable
                'albums' => 'nullable|array', // Ensure it's an array and can be nullable
                'albums.*' => 'nullable|exists:albums,id', // Validate each album ID, can be nullable
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
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
    } catch (ModelNotFoundException $e) {
        return redirect()->route('home.index')->with('error', 'Gallery not found.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating gallery.');
    }
}

public function destroy($id)
{
    try {
        $user = Auth::user();
        $gallery = Gallery::findOrFail($id);

        // Verifikasi izin pengguna
        if ($user->role === 'admin' || $gallery->user_id === $user->id) {

            // Hapus galeri
            $gallery->delete();

            // Hapus kategori terkait
            $gallery->categories()->detach();
            // Hapus file gambar dari penyimpanan
            Storage::disk('public')->delete($gallery->image_path);

            return redirect()->route('galleries.action')->with('success', 'Gallery has been deleted.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    } catch (\Exception $e) {
        return redirect()->route('galleries.action')->with('error', 'Failed to delete gallery: ' . $e->getMessage());
    }
}

public function userGalleries()
{
    try {
        // Periksa apakah pengguna telah masuk
        if (Auth::check()) {
            // Mendapatkan data pengguna yang sedang login
            $user = User::find(Auth::id());

            // Memperoleh galeri pengguna yang sedang login
            $userGalleries = $user->galleries()->get();

            // Mengirimkan data ke tampilan galeri pengguna
            return view('dashboard.user_galleries.index', compact('user', 'userGalleries'));
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to view your galleries.');
        }
    } catch (\Exception $e) {
        return redirect()->route('home.index')->with('error', 'Failed to fetch user galleries: ' . $e->getMessage());
    }
}
}

