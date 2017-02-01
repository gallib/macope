@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @include('macope::helpers.form-message')
                <div class="panel-body">
                    <table class="table table-bordered table-condensed" id="account-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Iban</th>
                                <th>Currency</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                <td>
                                    <a href="{{ route('accounts.show', $account->id) }}" title="View details">{{ $account->name }}</a>
                                </td>
                                <td>{{ $account->description }}</td>
                                <td>{{ $account->iban }}</td>
                                <td>{{ $account->currency }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('accounts.edit', $account->id) }}">Edit</a>
                                    @if ($account->journalEntries()->count() === 0)
                                        {{ Form::open(['method' => 'DELETE','route' => ['accounts.destroy', $account->id], 'style'=>'display:inline']) }}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
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
        pageLength: 25
    });
});
</script>
@endpush