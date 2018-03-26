@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success') > 0)
    <div class="alert alert-success">
        @foreach (session('success') as $success)
            <p>{{ $success }}</p>
        @endforeach
    </div>
@endif
