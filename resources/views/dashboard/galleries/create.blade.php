@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">
{{ Breadcrumbs::render('galleries.create') }}
    <div class="container mx-auto overflow-hidden ">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Create Gallery</h2>
        @include('dashboard.partials.errors')
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto" id="galleryForm">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-200 font-bold">Title:</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 dark:text-gray-200 font-bold">Description:</label>
                <textarea name="description" id="description" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"></textarea>
            </div>

            @include('dashboard.partials.todo-category')

            <div class="mb-4">
                <label for="image" class="block text-gray-700 dark:text-gray-200 font-bold">Image:</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full dark:bg-gray-700 dark:border-gray-600">
                <div id="imagePreview" class="mt-2"></div> <!-- Image preview container -->
            </div>

            <button type="button" id="submitForm" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Submit</button>
        </form>
    </div>
</div>
@push('script')
<script>
    document.getElementById("image").addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = document.getElementById("imagePreview");
                imagePreview.innerHTML = ""; // Clear previous preview
                const img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("w-32", "h-auto", "mt-2", "object-cover");
                imagePreview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
