@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('macope::helpers.filter')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-condensed" id="journal-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Text</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($entries as $entry)
                            <tr>
                                <td>{{ $entry->date }}</td>
                                <td>{{ $entry->text }}</td>
                                <td>{{ $entry->credit }}</td>
                                <td>{{ $entry->debit }}</td>
                                <td>{{ $entry->balance }}</td>
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
            }
        ]
    });
});
</script>
@endpush