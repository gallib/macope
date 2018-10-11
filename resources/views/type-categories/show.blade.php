@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Type category details</h5>
                    <p><span class="font-weight-bold">Name: </span>{{ $typeCategory->name }}</p>
                    <p><span class="font-weight-bold">Related categories:</span>
                        @foreach ($typeCategory->categories as $category)
                            <a href="{{ route('categories.show', $category->id) }}"><span class="badge badge-pill badge-primary">{{ $category->name }}</span></a>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5>Monthly expenses</h5>
                    <monthly-expenses-by-type-category type-category="{{ $typeCategory->id }}"></monthly-expenses-by-type-category>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection