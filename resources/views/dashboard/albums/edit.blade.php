@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-16">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-8">Edit Album</h1>
        <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" class="form-input w-full rounded-md border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:bg-gray-800 dark:text-white" value="{{ $album->title }}" placeholder="Enter title">
                @error('title')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Description:</label>
                <textarea name="description" id="description" class="form-textarea w-full rounded-md border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:bg-gray-800 dark:text-white" rows="3" placeholder="Enter description">{{ $album->description }}</textarea>
                @error('description')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="status" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Status:</label>
                <div class="flex items-center">
                    <input type="checkbox" name="status" id="status" value="public" {{ $album->status == 'public' ? 'checked' : '' }} class="form-checkbox mr-2 h-5 w-5 text-blue-500 rounded dark:text-gray-400 dark:bg-gray-800 focus:ring-blue-500 dark:focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                    <label for="status" class="text-gray-700 dark:text-gray-300">Public</label>
                </div>
                @error('status')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="cover_image" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Cover Image:</label>
                <input type="file" name="cover_image" id="cover_image" class="form-input w-full rounded-md border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                @error('cover_image')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Album</button>
            </div>
        </form>
    </div>
</div>
@endsection
