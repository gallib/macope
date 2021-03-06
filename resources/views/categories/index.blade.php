@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">Categories</h5>
                        <div class="ml-auto">
                            <a href="{{ route('categories.create') }}" title="Add a category" class="btn btn-primary btn-sm">Add</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="categories-table">
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
                                    <td class="nowrap">
                                        <a href="{{ route('categories.show', $category->id) }}" title="View details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($category->journal_entries_count === 0)
                                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn-icon" type="submit">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
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
    $('#categories-table').DataTable({
        pageLength: 25,
        columnDefs: [
            {orderable: false, targets: 2}
        ]
    });
});
</script>
@endpush