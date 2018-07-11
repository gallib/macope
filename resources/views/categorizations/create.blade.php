@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add a categorization</h5>
                    @include('helpers.form-message')
                    {{ Form::open(['url' => route('categorizations.store')]) }}
                    <div class="form-group">
                        {{ Form::label('search', 'Search') }}
                        {{ Form::text('search', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('search_type', 'Search type') }}
                        {{ Form::select('search_type', $searchTypes, null, ['class' => 'form-control']) }}
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