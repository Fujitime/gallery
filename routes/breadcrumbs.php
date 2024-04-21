<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Create User', route('users.create'));
});

Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push('Edit User', route('users.edit', $user));
});

// Albums
Breadcrumbs::for('albums.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Albums', route('albums.index'));
});

Breadcrumbs::for('albums.create', function ($trail) {
    $trail->parent('albums.index');
    $trail->push('Create Album', route('albums.create'));
});

Breadcrumbs::for('albums.edit', function ($trail, $album) {
    $trail->parent('albums.index');
    $trail->push('Edit Album', route('albums.edit', $album));
});

// Galleries
Breadcrumbs::for('galleries.action', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Galleries', route('galleries.action'));
});

Breadcrumbs::for('galleries.create', function ($trail) {
    $trail->parent('galleries.action');
    $trail->push('Create Gallery', route('galleries.create'));
});

// Breadcrumbs untuk edit galeri
Breadcrumbs::for('galleries.edit', function ($trail, $gallery) {
    $trail->parent('galleries.action');
    $trail->push('Edit Gallery', route('galleries.edit', $gallery->id));
});

// Comments
Breadcrumbs::for('comments.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Comments', route('comments.index'));
});

Breadcrumbs::for('comments.edit', function ($trail, $comment) {
    $trail->parent('comments.index');
    $trail->push('Edit Comment', route('comments.edit', $comment));
});

// Categories
Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('categories.index'));
});

Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories.index');
    $trail->push('Create Category', route('categories.create'));
});

Breadcrumbs::for('categories.edit', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push('Edit Category', route('categories.edit', $category));
});

//luar dashboard
Breadcrumbs::for('home.index', function ($trail) {
    $trail->push('Home', route('home.index'));
});

Breadcrumbs::for('galleries.show', function ($trail, $gallery) {
    $trail->parent('home.index');
    $trail->push('Image', route('galleries.show', $gallery));
});

Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('home.index');
    $trail->push('User', route('users.show', $user));
});
