@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">
@auth
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Create Gallery</h2>

        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto" id="galleryForm">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold">Title:</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold">Description:</label>
                <textarea name="description" id="description" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Categories:</label>

                <div class="flex justify-between items-center mb-4">

                <select id="categorySelect"  class="w-3/4 p-2 border rounded focus:outline-none focus:border-blue-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" id="addCategory" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Add Category</button>
            </div>
            </div>
            <div id="categoryList" class="my-10" >
                    <!-- List of selected categories will appear here -->
                </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Albums:</label>

                <div class="flex justify-between items-center mb-4">
                <select id="albumSelect" class="w-3/4 p-2 border rounded focus:outline-none focus:border-blue-500">
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                    @endforeach
                </select>
                <button type="button" id="addAlbum" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700 ml-2">
                    Add Album
                </button>
            </div>
            <div id="albumList" class="my-10">
                    <!-- List of selected albums will appear here -->
                </div>

            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold">Image:</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full">
            </div>

            <button type="button" id="submitForm" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Submit</button>
        </form>
    </div>
    </div>
@else
    <p class="text-red-500">You must be logged in to access this page.</p>
@endauth

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryList = document.getElementById('categoryList');
    const categorySelect = document.getElementById('categorySelect');
    const addCategoryBtn = document.getElementById('addCategory');
    const albumList = document.getElementById('albumList');
    const albumSelect = document.getElementById('albumSelect');
    const addAlbumBtn = document.getElementById('addAlbum');

    const selectedCategories = [];
    const selectedAlbums = [];

    function addItem(select, list, array) {
        const selectedItem = select.options[select.selectedIndex];
        const itemId = selectedItem.value;
        const itemName = selectedItem.text;
        array.push(itemId);
        const listItem = document.createElement('li');
        listItem.classList.add('flex', 'items-center', 'my-3');
        listItem.textContent = itemName;
        const deleteBtn = document.createElement('button');
        deleteBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-500" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>`;
        deleteBtn.classList.add('delete', 'ml-2', 'text-red-500');
        listItem.appendChild(deleteBtn);
        list.appendChild(listItem);
        // Hide the selected item from the dropdown
        selectedItem.remove();
    }

    function removeItem(event, select, array) {
        const listItem = event.target.parentElement;
        const selectId = select.id.replace('List', 'Select');
        const selectElement = document.getElementById(selectId);
        const option = document.createElement('option');
        option.value = listItem.textContent.trim();
        option.textContent = listItem.textContent.trim();
        selectElement.appendChild(option);
        array.splice(array.indexOf(option.value), 1);
        listItem.remove();
    }

    addCategoryBtn.addEventListener('click', function() {
        addItem(categorySelect, categoryList, selectedCategories);
    });

    addAlbumBtn.addEventListener('click', function() {
        addItem(albumSelect, albumList, selectedAlbums);
    });

    // Event delegation to handle delete buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete')) {
            const parentList = event.target.parentElement.parentElement;
            if (parentList === categoryList) {
                removeItem(event, categorySelect, selectedCategories);
            } else if (parentList === albumList) {
                removeItem(event, albumSelect, selectedAlbums);
            }
        }
    });

    const submitFormBtn = document.getElementById('submitForm');
    submitFormBtn.addEventListener('click', function() {
        const form = document.getElementById('galleryForm');
        // Add selected categories and albums as hidden inputs to the form
        selectedCategories.forEach(categoryId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'categories[]';
            input.value = categoryId;
            form.appendChild(input);
        });
        selectedAlbums.forEach(albumId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'albums[]';
            input.value = albumId;
            form.appendChild(input);
        });
        // Submit the form
        form.submit();
    });
});
</script>
@endpush
@endsection
