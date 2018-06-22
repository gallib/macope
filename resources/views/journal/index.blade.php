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
    $('#journal-table').DataTable({
        order: [[0, 'desc']],
        pageLength: 25,
        columns: [
            {data: 'date', type: 'date'},
            {data: 'text'},
            {data: 'category'},
            {data: 'credit'},
            {data: 'debit'},
            {data: 'id'},
        ],
        columnDefs: [
            {
                render: function (data, type, row) {
                    if (!data) {
                        return '';
                    }

                    return data.name + ' (' + data.type_category.name + ')';
                },
                targets: 2
            },
            {
                orderable: false,
                render: function (data, type, row) {
                    return '<a href="' + window.location.pathname + '/' + data + '/edit" title="Edit"><i class="fa fa-pencil"></i></a>';
                },
                targets: 5
            }
        ],

        processing: true,
        deferRender: true,
        ajax: window.location.pathname,
        stateSave: true
    });
});
</script>
@endpush