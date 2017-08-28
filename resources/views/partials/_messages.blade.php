@if ($flash = session('message'))

    <div class="alert alert-success" role="alert">
        {{ $flash }}
    </div>

@endif

@if (count($errors) > 0)

    <div class="alert alert-danger" role="alert">
        <strong>Errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif