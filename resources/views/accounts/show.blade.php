@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Account details</h5>
                    <p><span class="font-weight-bold">Description: </span>{{ $account->description }}</p>
                    <p><span class="font-weight-bold">Account number: </span>{{ $account->account_number }}</p>
                    <p><span class="font-weight-bold">Iban: </span>{{ $account->iban }}</p>
                    <p><span class="font-weight-bold">Currency: </span>{{ $account->currency }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection