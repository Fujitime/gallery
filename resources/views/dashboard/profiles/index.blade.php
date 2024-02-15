@extends('dashboard.layout')

@section('content')

<div class="lg:ml-64 p-5 mt-32">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-l-4 border-green-500 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-l-4 border-red-500 p-4 mb-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-center">
                        @if($user->profile_image)
                        <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" alt="Profile Image" class="w-32 h-32 rounded-full mx-auto">
                        @else
                            <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="relative inline-flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 border border-solid border-green-700 mx-auto">
                                <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr($user->username, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('profile.update.photo') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="my-5">
                        <input type="file" id="profile_photo" name="profile_image" accept="image/*">
                        <button class="mt-5 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit" id="submitPhoto">Upload</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="p-4">
                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <h6 class="text-sm font-medium text-gray-500 mb-4">User information</h6>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name<span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Name" value="{{ old('name', Auth::user()->name) }}">
                            </div>
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" id="username" name="username" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Last name" value="{{ old('username', Auth::user()->username) }}">
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address<span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="example@example.com" value="{{ old('email', Auth::user()->email) }}">
                            </div>
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Current password</label>
                                <input type="password" id="current_password" name="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Current password">
                            </div>
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700">New password</label>
                                <input type="password" id="new_password" name="new_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="New password">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
