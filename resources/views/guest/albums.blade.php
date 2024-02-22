@extends('layouts.app-master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Albums</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($albums as $album)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset($album->cover_image) }}" alt="{{ $album->title }}" class="w-full h-48 object-cover object-center">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $album->title }}</h2>
                <p class="text-gray-600">{{ $album->description }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-gray-500">{{ $album->created_at->diffForHumans() }}</span>
                    <a href="{{ route('albums.show', $album) }}" class="text-blue-500 hover:underline">View Album</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
