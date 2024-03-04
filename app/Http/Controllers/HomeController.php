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

        // Filter by search keyword
        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;
            $galleries->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%");
            });
        }

        // Filter by categories
        if ($request->has('categories')) {
            $selectedCategories = explode(',', $request->categories);
            $galleries->whereHas('categories', function ($query) use ($selectedCategories) {
                $query->whereIn('name', $selectedCategories);
            });
        }

        $galleries = $galleries->get();
        $latestImage = Gallery::latest()->first();
        $categories = Category::all();

        return view('home.index', compact('galleries', 'latestImage', 'user', 'categories', 'selectedCategories'));
    }

    public function getSearchSuggestions(Request $request)
    {
        $keyword = $request->query('keyword');

        // Query untuk mendapatkan saran pencarian dari database
        $suggestions = Gallery::where('title', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->select('title')
            ->distinct()
            ->get()
            ->pluck('title');

        return response()->json($suggestions);
    }

}
