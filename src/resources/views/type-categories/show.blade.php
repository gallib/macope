@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $typeCategory->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Informations
                    </div>
                </div>
                <div class="card-block">
                    <p><span class="font-weight-bold">Name: </span>{{ $typeCategory->name }}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Related categories
                    </div>
                </div>
                <div class="card-block">
                    @foreach ($typeCategory->categories as $category)
                        <a href="{{ route('categories.show', $category->id) }}"><span class="badge badge-pill badge-primary">{{ $category->name }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection