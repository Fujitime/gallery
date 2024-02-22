@extends('dashboard.layout')

@section('content')
<div class="p-4 sm:ml-64 pt-20">
    <div class="container mx-auto px-4">

    <h1 class="text-3xl dark:text-white md:text-3xl font-bold text-gray-800">Welcome back, {{ auth()->user()->username }}!</h1>

   <!-- Content -->
   <div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <svg class="mr-2 flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                        <div class="text-2xl font-semibold">{{ $totalUsers ?? 'Data tidak tersedia' }}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400 dark:text-gray-300">Total Pengguna</div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="flex items-center mb-1">
                        <svg class="mr-2 flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <div class="text-2xl font-semibold">{{ $totalCategories ?? 'Data tidak tersedia' }}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400 dark:text-gray-300">Total Kategori</div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <svg class="mr-2 flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" >
                            <path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
                        <div class="text-2xl font-semibold mb-1">{{$totalAllGalleries ?? 'Data tidak tersedia'}}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400 dark:text-gray-300">Total Foto</div>
                </div>

            </div>
        </div>
    </div>



            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white dark:bg-gray-800 border dark:border-gray-500 w-full shadow-lg rounded">
    <div class="rounded-t mb-0 px-0 border-b border-gray-200 dark:border-gray-500">
        <div class="flex flex-wrap items-center px-4 py-2">
            <div class="relative w-full max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Users</h3>
            </div>
        </div>
        <div class="block w-full">
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 dark:bg-gray-600 bg-gray-100 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Role</th>
                        <th class="px-4 dark:bg-gray-600 bg-gray-100 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Amount</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-100">
                    <tr>
                        <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">Admin</th>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ $totalAdmins ?? 'Data tidak tersedia' }}</td>
                    </tr>
                    <tr>
                        <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">User</th>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ $totalRegularUsers ?? 'Data tidak tersedia' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



    <div class="bg-white dark:bg-gray-800 border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="flex justify-between mb-4 items-start">
            <div class="font-medium">Foto Terbaru</div>
        </div>
        <div class="overflow-x-auto">
            @foreach($recentAllGalleries as $gallery)
            <div class="py-2 px-4 border-b border-b-gray-50">
                <div class="flex items-center">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-10 h-10 object-cover rounded">
                    <a href="{{ route('galleries.show', $gallery->id) }}" class="text-gray-600 dark:text-gray-200 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $gallery->title }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

        </div>
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
