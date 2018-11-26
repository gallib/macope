@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add a categorization</h5>
                    <form method="POST" action="{{ route('categorizations.store') }}">
                        @include('categorizations.form')
                        <input type="submit" name="submit" class="btn btn-primary" value="Create">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection