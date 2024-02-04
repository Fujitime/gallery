<!-- File: resources/views/home/index.blade.php -->

@extends('layouts.app-master')

@section('content')
<div class="container mx-auto my-8">
    @auth
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome back, {{ auth()->user()->username }}!</h1>
    @endif

    <div class="my-4">
        <a href="{{ route('categories.index') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
            View Categories
        </a>
    </div>

    <!-- Tampilkan galeri jika ada -->
    @if(count($galleries) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($galleries as $gallery)
                <div class="relative bg-white rounded overflow-hidden shadow-md">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover rounded">
                    @if($gallery->category)
                        <div class="absolute top-0 left-0 p-2">
                            <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $gallery->category->name }}</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-bold mb-2">{{ $gallery->title }}</h3>
                        <p class="text-gray-600">{{ $gallery->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No galleries available.</p>
    @endif
</div>
</div>
@endsection
