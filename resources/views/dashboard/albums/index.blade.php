@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-16">
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-semibold">My Albums</h1>
            <a href="{{ route('albums.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-block dark:bg-blue-700 dark:hover:bg-blue-800">Create New Album</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($albums as $album)
            @if ($album->user_id === Auth::id() || Auth::user()->role === 'admin' || $album->status === 'public')
            <div class="border p-4 bg-white dark:bg-gray-800">
            <a href="{{ route('albums.show', $album) }}">
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Cover Image" class="w-full h-40 object-cover mb-2">
                    <h2 class="text-lg font-semibold mb-2">{{ $album->title }}</h2>
                    <p class="text-sm mb-2">{{ $album->description }}</p>
                    <p class="text-sm mb-2">Created by:{{ substr($album->user->username, 0, 7) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Status: {{ ucfirst($album->status) }}</span>
                        <div>
                            @if ($album->user_id === Auth::id() || Auth::user()->role === 'admin')
                            <a href="{{ route('albums.edit', $album) }}" class="text-yellow-500 hover:underline dark:text-yellow-400 dark:hover:text-yellow-300 mr-2">Edit</a>
                            <form action="{{ route('albums.destroy', $album) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this album?')">Delete</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endif
            @empty
            <div class="text-gray-600 dark:text-gray-400 col-span-full">No albums found.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
