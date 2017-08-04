@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Categorizations</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Categorizations
                        <a href="{{ route('categorizations.create') }}" title="Add a categorization" class="btn btn-primary btn-sm pull-right">Add</a>
                    </div>
                </div>
                <div class="card-block">
                    @include('macope::helpers.form-message')
                    <table class="table table-bordered table-condensed" id="categorizations-table">
                        <thead>
                            <tr>
                                <th>Search</th>
                                <th>Type</th>
                                <th>Entry type</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($categorizations as $categorization)
                            <tr>
                                <td width="40%">{{ $categorization->search }}</td>
                                <td>{{ $categorization->type }}</td>
                                <td>{{ $categorization->entry_type }}</td>
                                <td>{{ $categorization->amount }}</td>
                                <td>{{ $categorization->category->name }} ({{$categorization->category->typeCategory->name}})</td>
                                <td>
                                    <a href="{{ route('categorizations.show', $categorization->id) }}" title="View details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categorizations.edit', $categorization->id) }}" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE','route' => ['categorizations.destroy', $categorization->id], 'style'=>'display:inline']) }}
                                        <button class="macope-delete" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    {{ Form::close() }}
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
    $('#categorizations-table').DataTable({
        pageLength: 25,
        columnDefs: [
            {orderable: false, targets: 5}
        ]
    });
});
</script>
@endpush