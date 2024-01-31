@if(isset($errors) && $errors->any())
    <div class="bg-yellow-200 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
        <ul class="list-disc list-inside mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    @php
        $data = Session::get('success');
    @endphp
    @if(is_array($data))
        @foreach($data as $msg)
            <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <i class="fas fa-check mr-2"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <i class="fas fa-check mr-2"></i>
            {{ $data }}
        </div>
    @endif
@endif
