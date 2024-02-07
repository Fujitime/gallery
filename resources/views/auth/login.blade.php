@extends('layouts.auth-master')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-500">
        <form method="post" action="{{ route('login.perform') }}" class="max-w-md bg-white shadow-md rounded-md px-8 py-6">
            @csrf

            <div class="text-center mb-8">
                <h1 class="text-3xl font-semibold text-gray-800">Login</h1>
            </div>

            @include('layouts.partials.messages')

            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm">Email or Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Your email or username" required autofocus class="form-input mt-1 block w-full rounded-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                @error('username')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required class="form-input mt-1 block w-full rounded-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring focus:border-blue-500" type="submit">Login</button>

            <div class="flex justify-between">
                {{-- Link to Register --}}
                <div class=" mt-4">
                    <p class="text-gray-700">Don't have an account?</p>
                    <a href="{{ route('register.show') }}" class="text-blue-500 hover:underline">Register here</a>
                </div>

                {{-- Button to Go Back --}}
                <div class=" mt-10">
                    <a href="{{ url('/') }}" class="text-blue-500 hover:underline">🔙Back</a>
                </div>
            </div>

            @include('auth.partials.copy')
        </form>
    </div>
@endsection
