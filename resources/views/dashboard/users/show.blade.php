@extends('layouts.app-master')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
<div class="my-10">
    {{ Breadcrumbs::render('galleries.show', $user) }}
</div>

    <div class="bg-white dark:bg-gray-900 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">User Information</h2>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1 break-all">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">{{ $user->name }}</dd>
                    </div>
                    <div class="sm:col-span-1 break-all">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">{{ $user->email }}</dd>
                    </div>
                    <div class="sm:col-span-1 break-all">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Username</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">{{ $user->username }}</dd>
                    </div>
                    <div class="sm:col-span-1 break-all">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Role</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">{{ ucfirst($user->role) }}</dd>
                    </div>
                    <!-- Add more fields as needed -->
                </dl>
            </div>
            <div class="p-6 flex justify-center items-center">
                @if($user->profile_image)
                <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" class="w-64 h-64 rounded-full object-cover" alt="{{ $user->name }}'s profile picture">
                @else
                <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="relative inline-flex items-center justify-center w-64 h-64 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-900 border border-solid border-green-700">
                        <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->username, 0, 1) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto my-8">
    <div class="text-center text-lg font-semibold mb-4 break-all">New Photos Uploaded by {{ Illuminate\Support\Str::limit($user->username, 30) }}</div>
    @include('dashboard.user_galleries.user_galleries')
</div>

@endsection
