@extends('layouts.app-master')

@section('content')
<div class="container mx-auto my-8">
    <h2 class="text-2xl font-bold mb-4">Create New Album</h2>

    <form action="{{ route('albums.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold">Title:</label>
            <input type="text" name="title" id="title" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold">Description:</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Create Album</button>
    </form>
</div>
@endsection
