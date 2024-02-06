@extends('layouts.app-master')

@section('content')
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">User Details</h2>

        <!-- Display user details -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Name:</label>
            <p class="p-2 border rounded">{{ $user->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Email:</label>
            <p class="p-2 border rounded">{{ $user->email }}</p>
        </div>
        <!-- Add more fields as needed -->

        @if(auth()->user()->role == 'admin')
            <!-- Admin-specific actions if needed -->
            <div class="mb-4">
                <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        @endif
    </div>
@endsection
