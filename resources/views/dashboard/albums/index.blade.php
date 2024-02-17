@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-4">My Albums</h1>
        <a href="{{ route('albums.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4">Create New Album</a>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($albums as $album)
            @if ($album->user_id === Auth::id() || Auth::user()->role === 'admin' || $album->status === 'public')
            <div class="border p-4">
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Cover Image" class="w-full h-40 object-cover mb-2">
                    <h2 class="text-lg font-semibold mb-2">{{ $album->title }}</h2>
                    <p class="text-sm mb-2">{{ $album->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Status: {{ ucfirst($album->status) }}</span>
                        <div>
                            <a href="{{ route('albums.show', $album) }}" class="text-blue-500 hover:underline mr-2">View</a>
                            @if ($album->user_id === Auth::id() || Auth::user()->role === 'admin')
                            <a href="{{ route('albums.edit', $album) }}" class="text-yellow-500 hover:underline mr-2">Edit</a>
                            <form action="{{ route('albums.destroy', $album) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
