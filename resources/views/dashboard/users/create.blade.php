@extends('dashboard.layout')

@section('content')
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Create New User</h2>

        <form action="{{ route('users.store') }}" method="POST" class="max-w-sm mx-auto">
            @csrf
            @include('dashboard.partials.errors')
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="email" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="username" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Username:</label>
            <input type="text" name="username" value="{{ old('username') }}" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="password" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
            <input type="password" name="password" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="role" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Role:</label>
            <select name="role"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <!-- Add more fields as needed -->

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 mt-4">Create User</button>
        </form>
    </div>
@endsection
