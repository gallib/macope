@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Create a category</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Create a category
                    </div>
                </div>
                <div class="card-body">
                    @include('macope::helpers.form-message')
                    {{ Form::open(['url' => route('categories.store')]) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('type_category_id', 'Type category') }}
                        {{ Form::select('type_category_id', $typeCategories, null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                {{ Form::checkbox('is_ignored', 1, null, ['class' => 'form-check-input']) }} Ignore category
                            </label>
                        </div>
                    </div>
                    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection