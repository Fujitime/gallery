@extends('layouts.auth-master')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-500">
        <form method="post" action="{{ route('login.perform') }}" class="max-w-sm bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="text-center mb-8">
                <img class="mx-auto mb-4" src="logo-url" alt="Logo" width="72" height="57">
                <h1 class="text-3xl font-semibold">Login</h1>
            </div>

            @include('layouts.partials.messages')

            <div class="mb-4">
                <label for="username" class="block text-gray-700">Email or Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus class="form-input mt-1 block w-full rounded-md">
                @error('username')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required class="form-input mt-1 block w-full rounded-md">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200" type="submit">Login</button>

            @include('auth.partials.copy')
        </form>
    </div>
@endsection
