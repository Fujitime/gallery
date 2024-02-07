@extends('layouts.app-master')

@section('content')
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Edit User</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold">Name:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold">Username:</label>
                <input type="text" name="username" id="username" value="{{ $user->username }}" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold">Password:</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-bold">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-bold">Role:</label>
                <select name="role" id="role" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Update User</button>
        </form>
    </div>
@endsection
