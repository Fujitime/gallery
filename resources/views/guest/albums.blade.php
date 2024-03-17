@extends('layouts.app-master')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Albums</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($albums as $album)
        <a href="{{ route('albums.show', $album) }}" class="">
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $album->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $album->description }}</p>
                   <div class="flex gap-2">
                    <span class="text-gray-700 dark:text-gray-500">Status:</span>
                   <p class="text-blue-500 dark:text-blue-500">{{ ucfirst($album->status) }}</p>
                   </div>
                   <p class="text-sm mb-2 italic text-gray-700 dark:text-gray-500">Created by: {{ substr($album->user->username, 0, 7) }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-gray-500">{{ $album->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
