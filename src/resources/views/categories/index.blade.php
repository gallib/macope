@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Categories</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Categories
                        <a href="{{ route('categories.create') }}" title="Add a category" class="btn btn-primary btn-sm pull-right">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('macope::helpers.form-message')
                    <table class="table table-bordered table-condensed" id="categories-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->typeCategory->name }}</td>
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}" title="View details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category->id) }}" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @if ($category->journalEntries()->count() === 0)
                                        {{ Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id], 'style'=>'display:inline']) }}
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
    $('#categories-table').DataTable({
        pageLength: 25,
        columnDefs: [
            {orderable: false, targets: 2}
        ]
    });
});
</script>
@endpush