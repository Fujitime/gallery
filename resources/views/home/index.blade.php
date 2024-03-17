@extends('layouts.app-master')

@section('content')
<div class="container pt-5 mx-auto">

@include('layouts.partials.search')

    <!-- Display selected categories -->
    <div id="selectedCategories" class="mt-4">
        @if ($selectedCategories)
            <div class="flex flex-wrap">
                @foreach ($selectedCategories as $category)
                <div class="inline-flex items-center px-2 py-1 mr-2 mb-2 text-sm font-medium text-white bg-blue-500 rounded-md">
                    {{ $category }}
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Display galleries -->
    @if(count($galleries) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
            @foreach($galleries as $gallery)
                <div class="relative overflow-hidden group w-full h-64">
                    <a href="{{ route('galleries.show', $gallery->id) }}" class="block w-full h-full">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover object-center rounded-md transition duration-300 transform group-hover:scale-105 hover:opacity-80">
                        <div class="absolute inset-0 flex items-center justify-center text-center p-4 bg-gray-800 bg-opacity-0 transition duration-300 opacity-0 group-hover:opacity-90">
                            <div>
                                <h2 class="text-xl font-semibold text-white">{{ $gallery->title }}</h2>
                                <p class="text-gray-300">{{ $gallery->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400">No galleries available.</p>
    @endif
</div>
@endsection
