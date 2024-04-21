@extends('layouts.app-master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Albums</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($albums as $album)
        <a href="{{ route('albums.show', $album) }}" class="group relative">
            <div class="border p-4 bg-white dark:bg-gray-800 relative overflow-hidden group-hover:shadow-lg">
                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Cover Image" class="w-full h-40 object-cover mb-2">
                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <svg class="text-gray-300 dark:text-white w-32 h-32 transition duration-300 transform scale-0 group-hover:scale-100" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm0 22c-5.522 0-10-4.477-10-10S6.478 2 12 2s10 4.477 10 10-4.478 10-10 10zm-3-9h2v4h-2zm3 4h-2v-4h2z"/>
                    </svg>
                </div>
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 bg-black bg-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-gray-300">
                        <path d="M9 3H15L17 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7L9 3ZM12 19C15.3137 19 18 16.3137 18 13C18 9.68629 15.3137 7 12 7C8.68629 7 6 9.68629 6 13C6 16.3137 8.68629 19 12 19ZM12 17C9.79086 17 8 15.2091 8 13C8 10.7909 9.79086 9 12 9C14.2091 9 16 10.7909 16 13C16 15.2091 14.2091 17 12 17Z"/>
                    </svg>
                </div>
                <div class="mb-4">
                    <h2 class="text-lg font-semibold mb-2">{{ $album->title }}</h2>
                    <p class="text-sm mb-2">{{ $album->description }}</p>
                    <p class="text-sm mb-2">Created by:{{ substr($album->user->username, 0, 7) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Status: {{ ucfirst($album->status) }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
