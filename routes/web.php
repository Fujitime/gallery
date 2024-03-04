<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckOwnProfile;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/sse/likes/{gallery}', [LikeController::class, 'sseLikes'])->name('sse.likes');
Route::post('/like', [LikeController::class, 'store'])->name('like.store');
Route::delete('/like/{id}', [LikeController::class, 'destroy'])->name('like.destroy');
Route::get('/search-suggestions', [HomeController::class, 'getSearchSuggestions'])->name('search-suggestions');
Route::get('/galleries/load-more', [GalleryController::class, 'loadMoreGalleries'])->name('galleries.load-more');

Route::middleware(['auth', CheckOwnProfile::class])->group(function () {
    Route::get('dashboard/profile/edit', [ProfileController::class, 'index'])->name('profile');
    Route::put('dashboard/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('dashboard/profile/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.update.photo');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Users Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard/users', [UserController::class, 'index'])->name('users.index');
    Route::get('dashboard/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('dashboard/users', [UserController::class, 'store'])->name('users.store');
    Route::get('dashboard/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('dashboard/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('dashboard/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Album dan Profile User Tanpa Login
Route::get('dashboard/user-galleries', [GalleryController::class, 'userGalleries'])->name('user.galleries');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
Route::get('public/albums', [AlbumController::class, 'guestIndex'])->name('guest.albums');


// Albums Routes
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/my-albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('dashboard/albums/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('dashboard/albums', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('dashboard/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('dashboard/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('dashboard/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/gallery/create', [GalleryController::class, 'create'])->name('galleries.create')->middleware('auth.create');
    Route::post('dashboard/galleries', [GalleryController::class, 'store'])->name('galleries.store')->middleware('auth.create');
    Route::get('dashboard/galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('dashboard/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('dashboard/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
});

Route::get('dashboard/galleries', [GalleryController::class, 'index']);
Route::get('dashboard/galleries/{id}', [GalleryController::class, 'show'])->name('galleries.show');
Route::get('dashboard/action/galleries', [GalleryController::class, 'action'])->name('galleries.action');

Route::middleware(['admin'])->group(function () {
    Route::resource('dashboard/categories', CategoryController::class);
});


Route::middleware(['guest'])->group(function () {
    Route::get('/register', 'App\Http\Controllers\RegisterController@show')->name('register.show');
    Route::post('/register', 'App\Http\Controllers\RegisterController@register')->name('register.perform');
    Route::get('/login', 'App\Http\Controllers\LoginController@show')->name('login.show');
    Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login.perform');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/comments', [CommentController::class, 'index'])->name('comments.action');
    Route::post('dashboard/galleries/{gallery}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('dashboard/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('dashboard/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('dashboard/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');
});
