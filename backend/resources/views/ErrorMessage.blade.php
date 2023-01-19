@if ($errors)
    <div class="alert alert-danger">
        @if (count($errors) > 0 )
        <ul style="display:block; padding:10px;">
            @foreach ($errors as $error)
            <li style="padding:10px 20px; color:red; display:inline;">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
@endif


@if(session()->has('message'))
    {{ session('message') }}
@endif
