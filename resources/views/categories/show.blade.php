@extends('layouts.app')

@section('content')
<div class="containe-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Category details</h5>
                    <p><span class="font-weight-bold">Name: </span>{{ $category->name }}</p>
                    <p>
                        <span class="font-weight-bold">Type category: </span>
                        <a href="{{ route('type-categories.show', $category->typeCategory->id) }}" title="View type category detail">{{ $category->typeCategory->name }}</a>
                    </p>
                    <p><span class="font-weight-bold">Is ignored: </span>{{ $category->is_ignored ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5>Monthly expenses</h5>
                    <monthly-expenses-by-category category="{{ $category->id }}"></monthly-expenses-by-category>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection