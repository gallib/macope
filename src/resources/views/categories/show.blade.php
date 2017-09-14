@extends('layouts.app')

@section('content')
<div class="containe-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $category->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Informations
                    </div>
                </div>
                <div class="card-body">
                    <p><span class="font-weight-bold">Name: </span>{{ $category->name }}</p>
                    <p>
                        <span class="font-weight-bold">Type category: </span>
                        <a href="{{ route('type-categories.show', $category->typeCategory->id) }}" title="View type category detail">{{ $category->typeCategory->name }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection