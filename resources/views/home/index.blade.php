@extends('layouts.app-master')

@section('content')
<div class="container mx-auto my-8">
    @auth
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome back, {{ auth()->user()->username }}!</h1>
    @endif
    <!-- <h2 class="text-2xl font-bold mb-4">Gallery Index</h2> -->

    <!-- Tampilkan galeri jika ada -->
    @if(count($galleries) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($galleries as $gallery)
                <div class="bg-white p-4 rounded border">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-32 object-cover mb-2 rounded">
                    <h3 class="text-lg font-bold">{{ $gallery->title }}</h3>
                    <p>{{ $gallery->description }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No galleries available.</p>
    @endif
</div>
    <!-- <div class="bg-gray-100 rounded-lg shadow-lg p-4 md:p-8">

        @auth
            <div class="mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome back, {{ auth()->user()->username }}!</h1>
                <a href="#" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 mt-2">Go to Profile</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-2">Total Images Uploaded</h2>
                    <p class="text-xl md:text-2xl font-bold text-blue-500">1200</p>
                </div>
                <div class="bg-white rounded-lg p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-2">Total Views</h2>
                    <p class="text-xl md:text-2xl font-bold text-blue-500">150,000</p>
                </div>
                <div class="bg-white rounded-lg p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-2">Most Popular Image</h2>
                    <div class="flex items-center">
                        <img src="image-url" alt="Popular Image" class="w-10 h-10 md:w-12 md:h-12 rounded-full">
                        <p class="ml-2 md:ml-4">Beautiful Sunset</p>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Welcome to Our Gallery App!</h1>
                <p class="text-lg md:text-xl text-gray-600 mb-6">Discover stunning images uploaded by users around the world. Login to explore and upload your own photos.</p>
                <a href="{{ route('login.perform') }}" class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">Login Now &raquo;</a>
            </div>
        @endauth
    </div> -->
@endsection
