@extends('layouts.app-master')

@section('content')

<div class="container pt-5 mx-auto">

    <!-- Display galleries -->
    @if(count($galleries) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galleries as $gallery)
                <div class="grid gap-4 relative">
                    <a href="{{ route('galleries.show', $gallery->id) }}">
                        <div class="relative">
                            <img class="max-h-44 object-cover w-full rounded-lg" src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}">
                            <div class="absolute top-0 left-0 w-full h-full bg-gray-700 opacity-0 hover:opacity-90 transition-opacity duration-300 flex justify-center items-center">
                                @if($gallery->user->profile_image)
                                    <img src="{{ asset('storage/profiles/' . $gallery->user->profile_image) }}" width="30" class="w-8 h-8 rounded-full mr-2" alt="Profile Image">
                                @else
                                    <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="mr-2 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-900 border border-solid border-green-700">
                                        <span class="font-medium text-white">{{ substr($gallery->user->username, 0, 1) }}</span>
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-white">{{ $gallery->user->username }}</span>
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
