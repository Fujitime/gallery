@extends('layouts.app-master')

@section('content')
<a href="{{ url()->previous() !== url()->current() ? url()->previous() : '/' }}"  class="hidden lg:block items-center justify-center hover:text-blue-600 text-white font-medium rounded-md shadow-sm transition duration-300 ease-in-out">
    <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000"><path d="M12 13V20L4 12L12 4V11H20V13H12Z"></path></svg>
</a>

<div class="lg:max-w-screen-lg mx-auto my-5">
    <div class="flex flex-col lg:flex-row lg:justify-between">
        <!-- Gambar -->
        <div class="lg:w-1/2 lg:pr-8">
        <img id="myImg" src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full max-h-80 rounded-md object-right">
            @include('layouts.partials.like')
        </div>

       <!-- The Modal -->
<div id="myModal" class="Mymodal">
    <span class="MyClose">&times;</span>
    <img class="Mymodal-content" id="Myimg01" alt="">
    <div id="Mycaption"></div>
</div>

        <!-- Detail Gallery -->
        <div class="lg:w-1/2 mt-8 lg:mt-0">
            <div class="flex justify-between">
                @include('layouts.partials.share')
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="dark:text-white text-black border border-black dark:border-white rounded-2xl text-sm px-3 pb-3 text-center inline-flex items-center focus:outline-none " type="button">
                    <span class="text-3xl" >...</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            @include('layouts.partials.download-img')
                        </li>
                        @if(optional(Auth::user())->id == optional($gallery->user)->id || optional(Auth::user())->role === 'admin')
                            <li>
                                <a href="{{ route('galleries.edit', $gallery->id) }}" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-blue-600 dark:text-blue-500 hover:underline" viewBox="0 0 576 512">
                                        <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                                    </svg>
                                    <span class="ml-2">Edit</span>
                                </a>
                            </li>
                            <li>
                                <a action="{{ route('galleries.destroy', $gallery->id) }}" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-600 dark:text-red-500 hover:underline" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                    <span class="ml-2">Delete</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="mt-10">
                <h1 class="text-4xl font-b">{{ $gallery->title }}</h1>
                <p class="p-2">{{ $gallery->description }}</p>
                <div class="flex items-center justify-between">
                    <a href="{{ route('users.show', $gallery->user) }}" class="flex items-center">
                        <!-- Foto profil -->
                        @if($gallery->user->profile_image)
                            <img src="{{ asset('storage/profiles/' . $gallery->user->profile_image) }}" width="30" class="w-10 h-10 rounded-full mr-2" alt="Profile Image">
                        @else
                            <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="mr-2 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-900 border border-solid border-green-700">
                                <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr($gallery->user->username, 0, 1) }}</span>
                            </div>
                        @endif
                        <!-- Nama pengguna -->
                        <div>
                            <p class="text-md">{{ $gallery->user->username }}</p>
                            <!-- Total galeri yang diunggah -->
                            <p class="text-sm text-gray-700"> {{ $totalGalleries }} Upload</p>
                            <!-- Tombol follow -->
                        </div>
                        <div class="ml-28 flex items-center">
                            <button class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                Follow
                            </button>
                        </div>
                    </a>
                </div>
            </div>
            @if(count($gallery->categories) > 0)
                <div class="mt-4">
                    <label class="block text-gray-700 dark:text-gray-300 font-bold">Categories:</label>
                    <div class="flex flex-wrap">
                        @php
                            // Array of colors
                            $colors = [
                                'bg-gray-200',
                                'bg-gray-900 dark:bg-gray-700',
                                'bg-blue-600',
                                'bg-green-500',
                                'bg-red-500',
                                'bg-purple-500',
                                'bg-indigo-500',
                                'bg-yellow-300',
                                'bg-teal-500',
                            ];
                        @endphp
                        @foreach($gallery->categories as $index => $category)
                            @php
                                // Get color class based on index
                                $colorClass = $colors[$index % count($colors)];
                            @endphp
                            <span class="mr-2">
                                <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                                    <span class="flex w-3 h-3 {{ $colorClass }} rounded-full me-3"></span>{{ $category->name }}
                                </span>
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
            @include('layouts.partials.comments')
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    window.onload = function() {
        // Get the modal
        var myModal = document.getElementById("myModal");
        var myImg = document.getElementById("myImg");
        var myModalImg = document.getElementById("Myimg01");
        var myCaptionText = document.getElementById("Mycaption");

        // Open the modal
        myImg.onclick = function() {
            myModal.style.display = "block";
            myModalImg.src = this.src;
            myCaptionText.innerHTML = this.alt;
        };

        // Get the close button
        var closeBtn = document.getElementsByClassName("MyClose")[0];

        // Close the modal when the close button is clicked
        closeBtn.onclick = function() {
            myModal.style.display = "none";
        };
    };
</script>
@endpush
