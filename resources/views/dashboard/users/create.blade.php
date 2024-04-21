@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-12">

    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Create New User</h2>

        <form action="{{ route('users.store') }}" method="POST" class="max-w-sm mx-auto">
            @csrf
            @include('dashboard.partials.errors')

            <!-- Name Field -->
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <!-- Email Field -->
            <label for="email" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <!-- Username Field -->
            <label for="username" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Username:</label>
            <input type="text" name="username" value="{{ old('username') }}" required
                   class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <!-- Password Field -->
            <label for="password" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
            <input type="password" name="password" required
                   class="form-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <!-- Role Field -->
            <label for="role" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Role:</label>
            <select name="role" required
                    class="form-select dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <!-- Add more fields as needed -->

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 mt-4">Create User</button>
        </form>
    </div>
    </div>
@endsection
