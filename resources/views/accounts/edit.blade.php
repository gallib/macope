@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $account->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        {{ $account->name }}
                    </div>
                </div>
                <div class="card-body">
                    @include('helpers.form-message')
                    {{ Form::model($account, ['url' => route('accounts.update', $account->id), 'method' => 'PUT']) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        {{ Form::text('description', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('account_number', 'Account number') }}
                        {{ Form::text('account_number', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('iban', 'Iban') }}
                        {{ Form::text('iban', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('currency', 'Currency') }}
                        {{ Form::text('currency', null, ['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection