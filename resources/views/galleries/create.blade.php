@extends('layouts.app-master')

@section('content')

@auth
<div class="container mx-auto my-8">
    <h2 class="text-2xl font-bold mb-4">Create Gallery</h2>

    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold">Title:</label>
            <input type="text" name="title" id="title" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold">Description:</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold">Category:</label>
            <select name="category_id" id="category_id" class="w-full p-2 border rounded">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold">Image:</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Submit</button>
    </form>
</div>
@else
    <p class="text-red-500">You must be logged in to access this page.</p>
@endauth

@endsection
