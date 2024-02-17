@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-8">Create Album</h1>
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
            <input type="text" name="title" id="title" class="form-input w-full" value="{{ old('title') }}" placeholder="Enter title">
            @error('title')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
            <textarea name="description" id="description" class="form-textarea w-full" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status:</label>
            <select name="status" id="status" class="form-select w-full">
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>
            @error('status')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="cover_image" class="block text-gray-700 font-bold mb-2">Cover Image:</label>
            <input type="file" name="cover_image" id="cover_image" class="form-input w-full">
            @error('cover_image')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Create Album</button>
        </div>
    </form>
</div>
</div>
@endsection
