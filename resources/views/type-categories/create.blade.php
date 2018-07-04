@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Create a type category</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Create a type category
                    </div>
                </div>
                <div class="card-body">
                    @include('helpers.form-message')
                    {{ Form::open(['url' => route('type-categories.store')]) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection