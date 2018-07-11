@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">Type categories</h5>
                        <div class="ml-auto">
                            <a href="{{ route('type-categories.create') }}" title="Add a type category" class="btn btn-primary btn-sm">Add</a>
                        </div>
                    </div>
                    @include('helpers.form-message')
                    <table class="table table-bordered table-condensed" id="type-categories-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($typeCategories as $typeCategory)
                            <tr>
                                <td>{{ $typeCategory->name }}</td>
                                <td>
                                    <a href="{{ route('type-categories.show', $typeCategory->id) }}" title="View details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('type-categories.edit', $typeCategory->id) }}" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @if ($typeCategory->categories()->count() === 0)
                                        {{ Form::open(['method' => 'DELETE','route' => ['type-categories.destroy', $typeCategory->id], 'style'=>'display:inline']) }}
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
    $('#type-categories-table').DataTable({
        pageLength: 25,
        columnDefs: [
            {orderable: false, targets: 1}
        ]
    });
});
</script>
@endpush