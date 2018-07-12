@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">Accounts</h5>
                        <div class="ml-auto">
                            <a href="{{ route('accounts.create') }}" title="Add an account" class="btn btn-primary btn-sm">Add</a>
                        </div>
                    </div>
                    @include('helpers.form-message')
                    <div class="table-responsive">
                        <table class="table table-hover" id="account-table">
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
                                    <td class="nowrap">
                                        <a href="{{ route('accounts.show', $account->id) }}" title="View details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('accounts.edit', $account->id) }}" title="Edit">
                                            <i class="fas fa-edit"></i>
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