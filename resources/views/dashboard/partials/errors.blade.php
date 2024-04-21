@if (session('success'))
        <div class="alert alert-success border-l-4 border-green-500 p-4 mb-4 dark:bg-gray-800" role="alert">
            {{ session('success') }}
        </div>
@endif


@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Oops! Something went wrong.</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
