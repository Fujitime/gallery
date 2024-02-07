@extends('layouts.app-master')

@section('content')
<div class="container mx-auto my-8">
    <h2 class="text-2xl font-bold mb-4">Your Albums</h2>

    @foreach($albums as $album)
        <div class="mb-4 p-4 border rounded">
            <h3 class="text-lg font-bold">{{ $album->title }}</h3>
            <p class="text-gray-600">{{ $album->description }}</p>
            <a href="{{ route('albums.show', $album) }}" class="text-blue-500 hover:text-blue-700">View Album</a>
        </div>
    @endforeach

    <a href="{{ route('albums.create') }}" class="text-blue-500 hover:text-blue-700">Create New Album</a>
</div>
@endsection
