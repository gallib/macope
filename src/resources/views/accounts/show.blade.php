@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $account->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
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