@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-12">
<div class="container mx-auto my-8">
            @include('dashboard.partials.errors')

    <h2 class="text-2xl font-bold mb-4">Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="max-w-sm mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Name:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block mt-4 text-sm font-medium text-gray-900 dark:text-white">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="username" class="block mt-4 text-sm font-medium text-gray-900 dark:text-white">Username:</label>
            <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="password" class="block mt-4 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
            <input type="password" name="password" id="password" class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block mt-4 text-sm font-medium text-gray-900 dark:text-white">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="role" class="block mt-4 text-sm font-medium text-gray-900 dark:text-white">Role:</label>
            <select name="role" id="role" class="form-select dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200 mt-4 w-full">Update User</button>
    </form>
</div>
@endsection
