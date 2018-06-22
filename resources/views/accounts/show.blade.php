@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $account->name }}</h1>
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
                <div class="card-body">
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