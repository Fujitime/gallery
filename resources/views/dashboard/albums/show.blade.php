@extends('layouts.app-master')

@section('content')
<div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <div class="" >
            <h1 class="text-3xl font-semibold mb-4">{{ $album->title }}</h1>
            <p class="text-md mb-1">Created by: {{ substr($album->user->username, 0, 7) }}</p>
            <p class="text-sm mb-3">Status: {{ ucfirst($album->status) }}</p>
            <p class="text-lg mb-4">{{ $album->description }}</p>
        </div>
        <!-- Tombol "Add Photo" di sebelah kanan -->

        @auth
        <div>
            <a href="{{ route('galleries.create', ['album_id' => $album->id]) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded inline-block">Add Photo</a>
        </div>
        @endauth
    </div>

    <!-- Daftar foto dalam album -->
    <h2 class="text-xl font-semibold">Images</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
        @forelse ($album->galleries as $gallery)
        <a href="{{ route('galleries.show', $gallery->id) }}">
            <div>
                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Image" class="w-full">
            </div>
        </a>
        @empty
        <p class="text-sm text-gray-600 col-span-4">No images found in this album.</p>
        @endforelse
    </div>
</div>
@endsection
