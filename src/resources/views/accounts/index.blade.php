@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Accounts</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Accounts
                        <a href="{{ route('accounts.create') }}" title="Add an account" class="btn btn-primary btn-sm pull-right">Add</a>
                    </div>
                </div>
                <div class="card-block">
                    @include('macope::helpers.form-message')
                    <table class="table table-bordered table-condensed" id="account-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Account number</th>
                                <th>Iban</th>
                                <th>Currency</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->description }}</td>
                                <td>{{ $account->account_number }}</td>
                                <td>{{ $account->iban }}</td>
                                <td>{{ $account->currency }}</td>
                                <td>
                                    <a href="{{ route('accounts.show', $account->id) }}" title="View details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('accounts.edit', $account->id) }}" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @if ($account->journalEntries()->count() === 0)
                                        {{ Form::open(['method' => 'DELETE','route' => ['accounts.destroy', $account->id], 'style'=>'display:inline']) }}
                                            <button class="macope-delete" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        {{ Form::close() }}
                                    @endif
                                </td>
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
    $('#account-table').DataTable({
        pageLength: 25,
        columnDefs: [
            {orderable: false, targets: 5}
        ]
    });
});
</script>
@endpush