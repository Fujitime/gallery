@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">

@auth
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Edit Gallery</h2>

        <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold">Title:</label>
                <input type="text" name="title" id="title" value="{{ $gallery->title }}" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold">Description:</label>
                <textarea name="description" id="description" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">{{ $gallery->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Categories:</label>
                @foreach ($categories as $category)
                    <div class="flex items-center">
                        <input type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, $gallery->categories->pluck('id')->toArray()) ? 'checked' : '' }} class="mr-2">
                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Albums:</label>
                @foreach ($albums as $album)
                    <div class="flex items-center">
                        <input type="checkbox" name="albums[]" id="album_{{ $album->id }}" value="{{ $album->id }}" {{ in_array($album->id, $gallery->albums->pluck('id')->toArray()) ? 'checked' : '' }} class="mr-2">
                        <label for="album_{{ $album->id }}">{{ $album->title }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold">Image:</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full">
                <p class="text-sm text-gray-500 mt-2">Leave empty if you don't want to change the image.</p>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Update</button>
        </form>
    </div>
    </div>
@else
    <p class="text-red-500">You must be logged in to access this page.</p>
@endauth

@endsection
