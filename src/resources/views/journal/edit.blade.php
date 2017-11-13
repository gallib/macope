@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ str_limit($journalEntry->text, 25) }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        {{ $journalEntry->text }}
                    </div>
                </div>
                <div class="card-body">
                    @include('macope::helpers.form-message')
                    {{ Form::model($journalEntry, ['url' => route('journal.update', $journalEntry->id), 'method' => 'PUT']) }}
                    <div class="form-group">
                        {{ Form::label('category_id', 'Category') }}
                        {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'No category']) }}
                    </div>

                    {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection