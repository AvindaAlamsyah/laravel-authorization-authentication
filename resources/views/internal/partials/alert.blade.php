@if ($errors->any())
    <div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button class="btn-close btn-close-white" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
    </div>
@endif
@if (session('status') && session('message'))
    <div class="alert alert-{{ session('status') }} bg-{{ session('status') }} text-light border-0 alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button class="btn-close btn-close-white" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
    </div>
@endif
