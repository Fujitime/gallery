@extends('layouts.app-master')

@section('content')
<div class="container mx-auto my-8">
    <h2 class="text-2xl font-bold mb-4">{{ $album->title }}</h2>

    <p class="mb-4">{{ $album->description }}</p>

    <a href="{{ route('albums.index') }}" class="text-blue-500 hover:text-blue-700">Back to Albums</a>
</div>
@endsection
