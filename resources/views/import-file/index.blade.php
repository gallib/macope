@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Import a file</h5>
                    @if ($accounts->count() == 0)
                        <div class="alert alert-warning">
                            <ul>
                                <li>Warning: no account has been set. <a href="{{ route('accounts.create') }}">Set up an account</a></li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('import-file.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" class="form-control-file {{ $errors->has('file') ? 'is-invalid' : '' }}" name="file" id="file">
                            </div>
                            @if ($errors->has('file'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('file') }}
                                </small>
                            @endif
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Import">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
