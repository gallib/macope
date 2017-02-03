@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $account->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('macope::helpers.form-message')
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