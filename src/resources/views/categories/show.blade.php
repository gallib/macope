@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $category->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Name: {{ $category->name }}</p>
                    <p>Type category: {{ $category->typeCategory->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection