@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Import a file</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Import a file
                    </div>
                </div>
                <div class="card-body">
                    @if ($accounts->count() == 0)
                        <div class="alert alert-warning">
                            <ul>
                                <li>Warning: no account has been set. <a href="{{ route('accounts.create') }}">Set up an account</a></li>
                            </ul>
                        </div>
                    @endif
                    @include('macope::helpers.form-message')
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
