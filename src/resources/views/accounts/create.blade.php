@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Create an account</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Create an account
                    </div>
                </div>
                <div class="card-body">
                    @include('macope::helpers.form-message')
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