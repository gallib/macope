@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit type category</h5>
                    <form method="POST" action="{{ route('type-categories.update', $typeCategory->id) }}">
                        @method('PUT')
                        @include('type-categories.form')
                        <input type="submit" name="submit" class="btn btn-primary" value="Edit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection