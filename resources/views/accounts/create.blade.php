@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add an account</h5>
                    @include('helpers.form-message')
                    {{ Form::open(['url' => route('accounts.store')]) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', '', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        {{ Form::text('description', '', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('account_number', 'Account number') }}
                        {{ Form::text('account_number', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                        {{ Form::label('iban', 'Iban') }}
                        {{ Form::text('iban', '', ['class' => 'form-control']) }}
                    </div>
                        {{ Form::label('currency', 'Currency') }}
                        {{ Form::text('currency', '', ['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection