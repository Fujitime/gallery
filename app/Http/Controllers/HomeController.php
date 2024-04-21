<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $user = User::find(Auth::id());
    $galleries = Gallery::query();
    $selectedCategories = [];

    // Validasi dan default value untuk parameter search
    $keyword = $request->filled('search') ? $request->search : '';

    // Filter by search keyword
    if (!empty($keyword)) {
        $galleries->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
        });
    }

    // Validasi dan default value untuk parameter categories
    $selectedCategories = $request->filled('categories') ? explode(',', $request->categories) : [];

    // Filter by categories
    if (!empty($selectedCategories)) {
        $galleries->whereHas('categories', function ($query) use ($selectedCategories) {
            $query->whereIn('name', $selectedCategories);
        });
    }

    $galleries = $galleries->get();
$latestImage = Gallery::latest()->first();
    $categories = Category::all();

    return view('home.index', compact('galleries', 'latestImage', 'user', 'categories', 'selectedCategories'));
}


    public function about()
    {
        return view('home.about');
    }
    public function contact()
    {
        return view('home.contact');
    }

    public function getSearchSuggestions(Request $request)
    {
        $keyword = $request->query('keyword');

        // Query untuk mendapatkan saran pencarian dari database
        $suggestions = Gallery::where('title', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->select('title')
            ->distinct()
            ->orderByRaw("CASE WHEN title LIKE '$keyword%' THEN 1 ELSE 2 END") // Urutkan berdasarkan relevansi
            ->take(5) // Ambil lima hasil teratas
            ->get()
            ->pluck('title');

        return response()->json($suggestions);
    }


}
