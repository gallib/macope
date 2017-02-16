@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $categorization->search }}</h1>
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
                <div class="card-block">
                    <p><span class="font-weight-bold">Search: </span>{{ $categorization->search }}</p>
                    <p><span class="font-weight-bold">Type: </span>{{ $categorization->type }}</p>
                    <p><span class="font-weight-bold">Category: </span>{{ $categorization->category->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection