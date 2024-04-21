@extends('layouts.app-master')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-4">Tentang Website Galeri</h1>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <div class="flex items-center mb-4">
                <img src="{{ asset('me.jpg') }}" alt="Foto Profil Fuji Halim Rabani" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-bold">Fuji Halim Rabani</p>
                        <p class="text-gray-500 dark:text-gray-400">Admin</p>
                    </div>
                </div>
                <p class="text-gray-700 dark:text-gray-300">
                    Website galeri ini dibuat oleh Fuji Halim Rabani, seorang siswa SMKN 01 Cisarua, sebagai bagian dari tugas proyek ujikom. Saya bertanggung jawab atas pengelolaan konten dan akan memastikan kualitas serta pengalaman pengguna.
                </p>
                <p class="text-gray-700 dark:text-gray-300 mt-4">
                    Untuk mengunggah gambar, pengguna harus mematuhi beberapa syarat:
                </p>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mt-2">
                    <li>Gambar harus memiliki kualitas yang baik dan relevan dengan tema galeri.</li>
                    <li>Gambar tidak boleh melanggar hak cipta atau privasi orang lain.</li>
                    <li>Pengguna harus memiliki hak atas gambar yang diunggah, atau mendapatkan izin dari pemiliknya jika diperlukan.</li>
                    <li>Gambar yang mengandung konten berbahaya, kekerasan, atau tidak pantas akan dihapus.</li>
                </ul>
                <p class="text-gray-700 dark:text-gray-300 mt-4">
                    Admin akan meninjau dan menghapus gambar yang melanggar syarat-syarat tersebut tanpa pemberitahuan sebelumnya.
                </p>
            </div>
        </div>
    </div>
@endsection
