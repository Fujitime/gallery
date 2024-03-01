<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckOwnProfile;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Register web routes for the application. Loaded by the RouteServiceProvider
| and assigned to the "web" middleware group.
|
*/

Route::get('/user-galleries', [GalleryController::class, 'userGalleries'])->name('user.galleries');

// Home Routes
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/sse/likes/{gallery}', [LikeController::class, 'sseLikes'])->name('sse.likes');
Route::post('/like', [LikeController::class, 'store'])->name('like.store');
Route::delete('/like/{id}', [LikeController::class, 'destroy'])->name('like.destroy');


Route::middleware(['auth', CheckOwnProfile::class])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.update.photo');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('users', UserController::class);
Route::resource('albums', AlbumController::class);

// Gallery Routes
Route::middleware(['auth'])->group(function () {
    Route::get('galleries/create', [GalleryController::class, 'create'])->name('galleries.create')->middleware('auth.create');
    Route::post('galleries', [GalleryController::class, 'store'])->name('galleries.store')->middleware('auth.create');
    Route::get('galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('galleries/{id}/update', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

});

Route::get('galleries', [GalleryController::class, 'index']);
Route::get('galleries/{id}', [GalleryController::class, 'show'])->name('galleries.show');
Route::get('/action/galleries', [GalleryController::class, 'action'])->name('galleries.action');

// Category Routes
Route::middleware(['admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});


Route::get('public/albums', [AlbumController::class, 'guestIndex'])->name('guest.albums');

// Authentication Routes
Route::middleware(['guest'])->group(function () {

    Route::get('/register', 'App\Http\Controllers\RegisterController@show')->name('register.show');
    Route::post('/register', 'App\Http\Controllers\RegisterController@register')->name('register.perform');

    Route::get('/login', 'App\Http\Controllers\LoginController@show')->name('login.show');
    Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login.perform');
});

// Logout Route
Route::middleware(['auth'])->group(function () {
    Route::post('/galleries/{gallery}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');
});
