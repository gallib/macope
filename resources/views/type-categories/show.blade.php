@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Type category details</h5>
                    <p><span class="font-weight-bold">Name: </span>{{ $typeCategory->name }}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Related categories</h5>
                    @foreach ($typeCategory->categories as $category)
                        <a href="{{ route('categories.show', $category->id) }}"><span class="badge badge-pill badge-primary">{{ $category->name }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection