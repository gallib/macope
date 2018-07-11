@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit journal entry</h5>
                    @include('helpers.form-message')
                    {{ Form::model($journalEntry, ['url' => route('journal.update', $journalEntry->id), 'method' => 'PUT']) }}
                    <div class="form-group">
                        {{ Form::label('date', 'Date') }}
                        {{ Form::text('date', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('text', 'Text') }}
                        {{ Form::textarea('text', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('category_id', 'Category') }}
                        {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'No category']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('credit', 'Credit') }}
                        {{ Form::text('credit', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('debit', 'Debit') }}
                        {{ Form::text('debit', null, ['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection