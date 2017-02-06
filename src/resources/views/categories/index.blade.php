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
                            <a href="{{ route('categories.create') }}" title="Add a category" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                                        <td>
                                            <a href="{{ route('categories.show', $category->id) }}" title="View details">{{ $category->name }}</a>
                                        </td>
                                        <td>{{ $category->typeCategory->name }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                            @if ($category->journalEntries()->count() === 0)
                                                {{ Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id], 'style'=>'display:inline']) }}
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
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#categories-table').DataTable({
        pageLength: 25
    });
});
</script>
@endpush