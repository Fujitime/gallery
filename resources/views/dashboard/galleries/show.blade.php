@extends('layouts.app-master')

@section('content')
<div class="lg:max-w-screen-lg mx-auto my-5">
<div class="my-10">
    {{ Breadcrumbs::render('galleries.show', $gallery) }}
</div>
    <div class="flex flex-col lg:flex-row lg:justify-between">

            <!-- Container untuk gambar -->
        <div class="lg:w-1/2 lg:pr-8 overflow-auto">
            <img id="myImg" src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="">
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
                @include('layouts.partials.download')
            </div>
            <div class="mt-10">
                <h1 class="text-4xl font-b">{{ $gallery->title }}</h1>
                <p class="p-2">{{ $gallery->description }}</p>
                <div class="flex items-center justify-between">
                @if($gallery->user)
                    <a href="{{ route('users.show', $gallery->user->id) }}" class="flex items-center">
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
                            <p class="text-sm text-gray-700 dark:text-gray-200 "> {{ $totalGalleries }} Upload</p>
                            <!-- Tombol follow -->
                        </div>
                        <div class="ml-28 flex items-center">
                            <button class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                Follow
                            </button>
                        </div>
                    </a>
                    @endif
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
