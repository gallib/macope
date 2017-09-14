@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $account->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Balances
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-condensed" id="monthly-balances-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($balances as $balance)
                            <tr>
                                <td>{{ $balance->date }}</td>
                                <td>{{ $balance->balance }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#monthly-balances-table').DataTable({
        pageLength: 25
    });
});
</script>
@endpush