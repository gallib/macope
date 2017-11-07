@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Journal</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Journal
                    </div>
                </div>
                <div class="card-body">
                    @include('macope::helpers.form-message')
                    {{ Form::open(['url' => route('journal.filter'), 'class' => 'form-inline']) }}
                        {{ Form::label('account', 'Account', ['class' => 'mb-2 mr-sm-2']) }}
                        {{ Form::select('account', $accounts, $account, ['class' => 'form-control mb-2 mr-sm-2']) }}
                        {{ Form::submit('Filter', ['class' => 'btn btn-primary mb-2 mr-sm-2']) }}
                    {{ Form::close() }}
                    <table class="table table-bordered table-condensed" id="journal-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Text</th>
                                <th>Category</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($entries as $entry)
                            <tr>
                                <td>{{ $entry->date }}</td>
                                <td>{{ $entry->text }}</td>
                                <td>
                                @if ($entry->category)
                                    {{ $entry->category->name }} ({{$entry->category->typeCategory->name}})
                                @endif
                                </td>
                                <td>{{ $entry->credit }}</td>
                                <td>{{ $entry->debit }}</td>
                                <td>
                                    <a href="{{ route('journal.edit', $entry->id) }}" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
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
    $.fn.dataTable.moment('DD/MM/YYYY');

    $('#journal-table').DataTable({
        order: [[0, 'desc']],
        pageLength: 25,
        columnDefs: [
            {
                render: function (data, type, row) {
                    return moment(new Date(data)).format('DD/MM/YYYY');
                },
                targets: 0
            },
            {orderable: false, targets: 5}
        ]
    });
});
</script>
@endpush