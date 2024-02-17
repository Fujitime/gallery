@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">

    <div class="container">
        <h1>Edit Album</h1>
        <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $album->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description">{{ $album->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image:</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    </div>
@endsection
