@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $categorization->search }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Search: {{ $categorization->search }}</p>
                    <p>Type: {{ $categorization->type }}</p>
                    <p>Category: {{ $categorization->category->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection