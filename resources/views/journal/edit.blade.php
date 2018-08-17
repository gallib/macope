@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit journal entry</h5>
                    @include('journal.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection