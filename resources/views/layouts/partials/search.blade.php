<form action="{{ route('home.index') }}" method="GET" class="max-w-lg mx-auto">
    <input type="hidden" name="categories" id="selectedCategories">
    <div class="flex gap-2">
        <button id="dropdown-button" type="button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-gray-600 dark:hover:text-white">
            <span>
            <svg fill="gray" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/></svg>
            </span>
            <svg  class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        <div id="dropdown" class="z-10 hidden bg-white dark:bg-gray-700 divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-300" aria-labelledby="dropdown-button">
                @foreach($categories as $category)
                <li>
                    <button type="button" class="category-button inline-flex w-full px-4 py-2" data-category="{{ $category->name }}">{{ $category->name }}</button>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="relative w-full">
            <input type="search" name="search" id="search" class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:focus:border-blue-500 dark:placeholder-gray-400" placeholder="Search..." autocomplete="off">
            <!-- Container untuk menampilkan saran pencarian -->
            <div id="searchSuggestions" class="absolute z-10 bg-white border border-gray-300 mt-1 w-full rounded-md shadow-lg hidden dark:bg-gray-700 dark:border-gray-600">
            </div>

            <button id="searchButton" type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@push('script')
<!-- JavaScript untuk meng-handle saran pencarian -->
<script>
let timeoutId;
let selectedIndex = -1;

const searchInput = document.getElementById('search');
const searchSuggestions = document.getElementById('searchSuggestions');
const searchButton = document.getElementById('searchButton');


document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.category-button');
    const selectedCategories = new Set();
    const selectedCategoriesContainer = document.getElementById('selectedCategoriesContainer');

    categoryButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');

            if (selectedCategories.has(category)) {
            selectedCategories.delete(category);
            this.classList.remove('bg-blue-500');
            this.classList.remove('text-white');
            // Hapus semua elemen ceklis yang mungkin sudah ada
            const existingCeklis = this.querySelectorAll('.spanCeklis');
            existingCeklis.forEach(ceklist => {
                ceklist.remove();
            });
        } else {
            selectedCategories.add(category);
            this.classList.add('bg-blue-500');
            this.classList.add('text-white');
            this.classList.add('flex');
            this.classList.add('justify-between');
            // Membuat elemen div baru untuk tanda centang
            const spanCeklis = document.createElement("div");
            spanCeklis.classList.add('spanCeklis');
            spanCeklis.innerHTML = "✅";
            // Memasukkan elemen tanda centang ke dalam elemen div yang sudah ada
            this.appendChild(spanCeklis);
        }



            // Update hidden input value
            const selectedCategoriesInput = document.getElementById('selectedCategories');
            selectedCategoriesInput.value = Array.from(selectedCategories).join(',');

            // Update selected categories display
            selectedCategoriesContainer.innerHTML = '';
            selectedCategories.forEach(function(cat) {
                const categoryBadge = document.createElement('div');
                categoryBadge.classList.add('inline-flex', 'items-center', 'px-2', 'py-1', 'mr-2', 'mb-2', 'text-sm', 'font-medium', 'text-white', 'bg-blue-500', 'rounded-md');
                categoryBadge.innerText = cat;
                selectedCategoriesContainer.appendChild(categoryBadge);
            });

            // Lakukan sesuatu dengan kategori yang dipilih, misalnya kirim permintaan ke server
            console.log('Selected categories:', Array.from(selectedCategories));
        });
    });
});



searchInput.addEventListener('input', function(event) {
    clearTimeout(timeoutId);
    const keyword = this.value.trim();

    // Menunggu 500ms setelah pengguna selesai mengetik sebelum mengirim permintaan pencarian
    timeoutId = setTimeout(() => {
        if (keyword !== '') {
            fetch(`/search-suggestions?keyword=${keyword}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const suggestions = data.map((suggestion, index) => `<div id="suggestion${index}" class="suggestion-item p-2">${highlightKeyword(suggestion, keyword)}</div>`).join('');
                        searchSuggestions.innerHTML = suggestions;
                        searchSuggestions.classList.remove('hidden');
                        selectedIndex = -1; // Reset indeks terpilih ketika ada perubahan dalam saran pencarian
                    } else {
                        searchSuggestions.innerHTML = '';
                        searchSuggestions.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error fetching search suggestions:', error);
                });
        } else {
            searchSuggestions.innerHTML = '';
            searchSuggestions.classList.add('hidden');
        }
    }, 500);
});

// Function untuk highlight keyword pada saran pencarian
function highlightKeyword(text, keyword) {
    const regex = new RegExp(keyword, 'gi');
    return text.replace(regex, match => `<span class="font-medium text-blue-500">${match}</span>`);
}

// Menangani klik pada saran pencarian
searchSuggestions.addEventListener('click', function(event) {
    const clickedSuggestion = event.target.closest('.suggestion-item');
    if (clickedSuggestion) {
        const selectedSuggestion = clickedSuggestion.textContent;
        searchInput.value = selectedSuggestion;
        this.innerHTML = ''; // Menghapus saran pencarian setelah dipilih
        this.classList.add('hidden');
        searchInput.focus(); // Fokuskan kembali ke input pencarian
    }
});

// Menangani tombol "Enter" dan perpindahan dengan tombol panah
searchInput.addEventListener('keydown', function(event) {
    const suggestions = document.querySelectorAll('.suggestion-item');

    if (event.key === 'ArrowUp') {
        event.preventDefault(); // Mencegah pergeseran kursor dalam input pencarian
        selectedIndex = (selectedIndex - 1 + suggestions.length) % suggestions.length;
        updateSelectedSuggestion();
    } else if (event.key === 'ArrowDown') {
        event.preventDefault(); // Mencegah pergeseran kursor dalam input pencarian
        selectedIndex = (selectedIndex + 1) % suggestions.length;
        updateSelectedSuggestion();
    } else if (event.key === 'Enter') {
        event.preventDefault(); // Mencegah pengiriman formulir

        if (selectedIndex >= 0 && selectedIndex < suggestions.length) {
            suggestions[selectedIndex].click(); // Klik pada saran pencarian yang dipilih
        } else {
            searchButton.click(); // Jika tidak ada saran yang dipilih, klik tombol pencarian
        }
    }
});

// Memperbarui tampilan saran pencarian yang dipilih
function updateSelectedSuggestion() {
    const suggestions = document.querySelectorAll('.suggestion-item');
    suggestions.forEach((suggestion, index) => {
        if (index === selectedIndex) {
            suggestion.classList.add('active');
            searchInput.value = suggestion.textContent;
        } else {
            suggestion.classList.remove('active');
        }
    });
}
</script>
@endpush
