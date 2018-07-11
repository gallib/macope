@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categorization details</h5>
                    <p><span class="font-weight-bold">Search: </span>{{ $categorization->search }}</p>
                    <p><span class="font-weight-bold">Search type: </span>{{ $categorization->search_type }}</p>
                    <p><span class="font-weight-bold">Entry type: </span>{{ $categorization->entry_type }}</p>
                    <p><span class="font-weight-bold">Amount: </span>{{ $categorization->amount }}</p>
                    <p>
                        <span class="font-weight-bold">Category: </span>
                        <a href="{{ route('categories.show', $categorization->category->id) }}" title="View category details">{{ $categorization->category->name }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection