@extends('dashboard.layout')

@section('content')
<div class="p-4 sm:ml-64 pt-20">
    <div class="container mx-auto px-4">
    <h1 class="text-3xl dark:text-white md:text-3xl font-bold text-gray-800">Welcome back, {{ auth()->user()->username }}!</h1>

    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('dashboard.admin-statistic')
    @endif

      <!-- End Content -->
        <!-- Statistik Umum -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold mb-4">Statistik Umum</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Smua foto<h3>
                    <p class="text-gray-600 dark:text-gray-400">{{$totalAllGalleries ?? 'Data tidak tersedia'}}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Admin</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalAdmins ?? 'Data tidak tersedia' }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Pengguna Biasa</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalRegularUsers ?? 'Data tidak tersedia' }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Kategori</h3>
                    <p class="text-gray-600 dark:text-gray-400"></p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Liked Galleries</h2>
                    @if ($mostLikedGallery->isNotEmpty())
                        <ul>
                            @foreach ($mostLikedGallery as $gallery)
                            @if ($gallery->likes_count > 0)
                                <li>{{ $gallery->title }} - {{ $gallery->likes_count }} Likes</li>
                            @endif
                            @endforeach
                        </ul>
                    @else
                        <p>No galleries found.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-8">
        <h3 class="text-2xl md:text-xl font-bold text-gray-800">Statistik Kamu</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Album</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalAlbums ?? 'Data tidak tersedia' }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Foto</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalGalleries ?? 'Data tidak tersedia' }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Jumlah Komentar</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalComments ?? 'Data tidak tersedia' }}</p>
                </div>
            </div>
        </div>
        <!-- Aktivitas Terkini -->
        <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4">Aktivitas {{ auth()->user()->name ?? auth()->user()->username ?? 'Pengguna' }} Terkini</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Album Terbaru</h3>
                    @forelse ($recentAlbums as $album)
                        <p class="text-gray-600 dark:text-gray-400"><a href="#">{{ $album->title }}</a></p>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">Tidak ada album terbaru.</p>
                    @endforelse
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Foto Terbaru</h3>
                    @forelse ($recentGalleries as $gallery)
                        <p class="text-gray-600 dark:text-gray-400"><a href="#">{{ $gallery->title }}</a></p>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">Tidak ada foto terbaru.</p>
                    @endforelse
                </div>
            </div>
            <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Komentar Terbaru</h3>
                @forelse ($recentComments as $comment)
                    <p class="text-gray-600 dark:text-gray-400">{{ $comment->content }}</p>
                @empty
                    <p class="text-gray-600 dark:text-gray-400">Tidak ada komentar terbaru.</p>
                @endforelse
            </div>
            <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Kategori Terbaru</h3>
                @forelse ($recentCategories as $category)
                    <p class="text-gray-600 dark:text-gray-400">{{ $category->name }}</p>
                @empty
                    <p class="text-gray-600 dark:text-gray-400">Tidak ada kategori terbaru.</p>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
