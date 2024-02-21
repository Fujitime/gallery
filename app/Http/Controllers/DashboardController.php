<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Album;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = User::find(Auth::id());

        // Memperoleh statistik umum
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $totalAllGalleries = Gallery::count();


        // Memperoleh jumlah album dan galeri milik pengguna yang sedang login
        $totalAlbums = Album::where('user_id', Auth::id())->count();
        $totalGalleries = Gallery::where('user_id', Auth::id())->count();

        // Memperoleh jumlah komentar pada galeri milik pengguna yang sedang login
        $totalComments = Comment::whereIn('gallery_id', function ($query) {
            $query->select('id')
                ->from('galleries')
                ->where('user_id', Auth::id());
        })->count();

        // Memperoleh galeri dengan jumlah like terbanyak
        $mostLikedGallery = Gallery::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->get();

        // Memperoleh aktivitas terkini pengguna yang sedang login
        $recentAlbums = Album::where('user_id', Auth::id())->latest()->take(5)->get();
        $recentGalleries = Gallery::where('user_id', Auth::id())->latest()->take(5)->get();
        $recentComments = Comment::whereIn('gallery_id', function ($query) {
            $query->select('id')
                ->from('galleries')
                ->where('user_id', Auth::id());
        })->latest()->take(5)->get();

        // Memperoleh kategori terbaru
        $recentCategories = Category::latest()->take(5)->get();

        // Memperoleh jumlah total kategori
        $totalCategories = Category::count();

        // Memperoleh distribusi kategori untuk pengguna yang sedang login
        $categoryDistribution = Category::withCount('galleries')
            ->whereHas('galleries', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        // Mengirimkan data ke tampilan dashboard
        return view('dashboard.dashboard', [
            'user' => $user,
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalRegularUsers' => $totalRegularUsers,
            'totalAlbums' => $totalAlbums,
            'totalGalleries' => $totalGalleries,
            'totalAllGalleries' => $totalAllGalleries,
            'totalComments' => $totalComments,
            'mostLikedGallery' => $mostLikedGallery,
            'recentAlbums' => $recentAlbums,
            'recentGalleries' => $recentGalleries,
            'recentComments' => $recentComments,
            'recentCategories' => $recentCategories,
            'totalCategories' => $totalCategories,
            'categoryDistribution' => $categoryDistribution,
        ]);
    }
}
