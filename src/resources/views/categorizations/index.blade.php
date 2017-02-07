@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Categories</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('macope::helpers.form-message')
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('categorizations.create') }}" title="Add a categorization" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-condensed" id="categorizations-table">
                                <thead>
                                    <tr>
                                        <th>Search</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($categorizations as $categorization)
                                    <tr>
                                        <td>
                                            <a href="{{ route('categorizations.show', $categorization->id) }}" title="View details">{{ $categorization->search }}</a>
                                        </td>
                                        <td>{{ $categorization->type }}</td>
                                        <td>{{ $categorization->category->name }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('categorizations.edit', $categorization->id) }}">Edit</a>
                                            {{ Form::open(['method' => 'DELETE','route' => ['categorizations.destroy', $categorization->id], 'style'=>'display:inline']) }}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
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
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#categorizations-table').DataTable({
        pageLength: 25
    });
});
</script>
@endpush