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
                    @include('helpers.form-message')
                    {{ Form::open(['url' => route('import-file.import'), 'files' => true]) }}
                    <div class="form-group">
                        {{ Form::label('file', 'File') }}
                        {{ Form::file('file') }}
                    </div>
                    {{ Form::submit('Import', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
