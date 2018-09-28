<!--  success is the name of the variable we store in flash -->
@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{Session::get('success') }}
    </div>

@endif

@if (!$errors->isEmpty())

    <div class="alert alert-danger" role="alert">
        <p> Errors: </p>
        <br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    </div>

@endif