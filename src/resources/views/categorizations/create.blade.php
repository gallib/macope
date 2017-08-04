@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Create a categorization</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Create a categorization
                    </div>
                </div>
                <div class="card-block">
                    @include('macope::helpers.form-message')
                    {{ Form::open(['url' => route('categorizations.store')]) }}
                    <div class="form-group">
                        {{ Form::label('search', 'Search') }}
                        {{ Form::text('search', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('type', 'Type') }}
                        {{ Form::select('type', $types, null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('entry_type', 'Entry type') }}
                        {{ Form::select('entry_type', $entryTypes, null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('amount', 'Amount') }}
                        {{ Form::text('amount', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('category_id', 'Category') }}
                        {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection