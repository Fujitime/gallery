@push('script')
<script>
    // Menjalankan unduh gambar
    function downloadImage() {
        const imageUrl = "{{ asset('storage/' . $gallery->image_path) }}";
        const fileName = '{{$gallery->title}}.jpg';

        fetch(imageUrl)
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(new Blob([blob]));
                const a = document.createElement('a');
                a.href = url;
                a.download = fileName;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Memanggil fungsi unduh gambar saat tombol diklik
    document.getElementById('downloadImg').addEventListener('click', function(event) {
        downloadImage();
    });


</script>
@endpush

<a href="#" id="downloadImg" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center">
    <svg class="h-5 w-5 fill-current text-green-600 dark:text-green-500 hover:underline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
    <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
    </svg>
    <span class="ml-2">Download Image</span>
</a>
