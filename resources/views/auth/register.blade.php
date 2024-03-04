@extends('layouts.auth-master')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-500">
        <form method="post" action="{{ route('register.perform') }}" class="max-w-md bg-white shadow-md rounded px-8 pt-6 pb-8 mb-2 grid grid-cols-2 gap-4">
            @csrf

            <div class="text-center col-span-2 mb-8">
                <h1 class="text-3xl font-semibold text-gray-800">Register</h1>
            </div>

            @include('layouts.partials.messages')

            <div class="mb-2">
                <label for="email" class="block text-gray-700 text-sm">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus class="form-input mt-1 block w-full rounded-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label for="username" class="block text-gray-700 text-sm">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus class="form-input mt-1 block w-full rounded-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                @error('username')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password" class="block text-gray-700 text-sm">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required class="form-input mt-1 block w-full rounded-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password_confirmation" class="block text-gray-700 text-sm">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required class="form-input mt-1 block w-full rounded-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                @error('password_confirmation')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label for="address" class="block text-gray-700 text-sm">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Bandung barat/Cisarua/Pasirlangu" required class="form-input mt-1 block w-full rounded-md px-4 py-2 border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                @error('address')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button class="col-span-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring focus:border-blue-500" type="submit">Register</button>

            <div class="text-gray-700 mt-2">
                <p>Already have an account?</p>
                <a href="{{ route('login.show') }}" class="text-blue-500 hover:underline">Login here</a>
            </div>

            <div class="text-gray-700 mt-2">
                <a href="{{ url('/') }}" class="text-blue-500 hover:underline">🔙Back</a>
            </div>

            @include('auth.partials.copy')
        </form>
    </div>
@endsection
