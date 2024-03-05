@extends('dashboard.layout')

@section('content')
<div class="p-4 sm:ml-64 pt-20">
    <div class="container mx-auto px-4">
    <h1 class="text-3xl dark:text-white md:text-3xl font-bold text-gray-800 overflow-hidden whitespace-nowrap">
        Welcome back, {{ auth()->user()->username }}!
    </h1>

    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('dashboard.admin-statistic')
    @endif

      <!-- End Content -->

        <div class="mb-8">
        <h3 class="text-2xl my-5 md:text-xl font-bold text-gray-800">Your Statistics</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Albums</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalAlbums ?? 'Data not available' }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Photos</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalGalleries ?? 'Data not available' }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Comments</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $totalComments ?? 'Data not available' }}</p>
                </div>
            </div>
        </div>
        <!-- Recent Activities -->
        <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4">Recent Activities</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Recent Albums</h3>
                    @forelse ($recentAlbums as $album)
                    <div class="py-2 px-4 border-b border-b-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}" class="w-10 h-10 object-cover rounded">
                        <a href="{{ route('galleries.show', $album->id) }}" class="text-gray-600 dark:text-gray-200 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $album->title }}</a>
                    </div>
                </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No recent albums.</p>
                    @endforelse
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-gray-700 dark:text-gray-300 font-semibold">Recent Photos</h3>
                    @forelse ($recentGalleries as $gallery)
                    <div class="py-2 px-4 border-b border-b-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-10 h-10 object-cover rounded">
                        <a href="{{ route('galleries.show', $gallery->id) }}" class="text-gray-600 dark:text-gray-200 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $gallery->title }}</a>
                    </div>
                </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No recent photos.</p>
                    @endforelse
                </div>
            </div>


    <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                <h3 class="text-gray-700 dark:text-gray-300 font-semibold">New Comments</h3>
                <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
    <div class="p-4 flex items-center">
      <div
        class="p-3 rounded-full text-teal-500 dark:text-teal-100 bg-teal-100 dark:bg-teal-500 mr-4">
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
          <path
            fill-rule="evenodd"
            d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          New {{ auth()->user()->name ?? auth()->user()->username ?? 'User' }} Comments
        </p>
        @forelse ($recentComments as $comment)
        <p class="text-gray-600 dark:text-gray-400">- {{ Str::limit($comment->content, 25) }}</p>
         @empty
             <p class="text-gray-600 dark:text-gray-400">No recent comments.</p>
         @endforelse
      </div>
    </div>
  </div>
            </div>


        </div>
    </div>
</div>
@endsection
