@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit account</h5>
                    <form method="POST" action="{{ route('accounts.update', $account->id) }}">
                        @method('PUT')
                        @include('accounts.form')
                        <input type="submit" name="submit" class="btn btn-primary" value="Edit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection