@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-4">{{ $album->title }}</h1>
    <p class="text-lg mb-4">{{ $album->description }}</p>
    <p class="text-sm">Status: {{ ucfirst($album->status) }}</p>
    <h2 class="text-xl font-semibold mt-8">Images</h2>
    <div class="grid grid-cols-3 gap-4 mt-4">
        @foreach ($album->galleries as $gallery)
        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Image" class="w-full">
        @endforeach
    </div>
</div>
    </div>
@endsection
