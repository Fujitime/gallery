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
        <div class="custom-row">
            @foreach($galleries as $gallery)
                <div class="custom-column relative overflow-hidden group">
                    <a href="{{ route('galleries.show', $gallery->id) }}">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="custom-image rounded-md transition duration-300 transform group-hover:scale-105">
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400">No galleries available.</p>
    @endif
</div>
@endsection
