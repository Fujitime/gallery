@extends('layouts.app-master')

@section('content')
<div class="container pt-5 mx-auto">
    <!-- Display galleries -->
    @if(count($galleries) > 0)
        @php $counter = 0; @endphp
        <div class="custom-row">
            @foreach($galleries as $gallery)
                @if($counter % 7 == 0 && $counter != 0)
                    </div>
                    <div class="custom-row">
                @endif
                <div class="custom-column">
                    <a href="{{ route('galleries.show', $gallery->id) }}">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="custom-image rounded-md">
                    </a>
                </div>
                @php $counter++; @endphp
            @endforeach
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400">No galleries available.</p>
    @endif
</div>
@endsection
