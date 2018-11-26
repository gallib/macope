@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">Categorizations</h5>
                        <div class="ml-auto">
                            <a href="{{ route('categorizations.create') }}" title="Add a categorization" class="btn btn-primary btn-sm">Add</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="categorizations-table">
                            <thead>
                                <tr>
                                    <th>Search</th>
                                    <th>Search type</th>
                                    <th>Entry type</th>
                                    <th>Amount</th>
                                    <th>Category</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($categorizations as $categorization)
                                <tr>
                                    <td>{{ $categorization->search }}</td>
                                    <td>{{ $categorization->search_type }}</td>
                                    <td>{{ $categorization->entry_type }}</td>
                                    <td>{{ $categorization->amount }}</td>
                                    <td>{{ $categorization->category->name }} ({{$categorization->category->typeCategory->name}})</td>
                                    <td class="nowrap">
                                        <a href="{{ route('categorizations.show', $categorization->id) }}" title="View details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categorizations.edit', $categorization->id) }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('categorizations.destroy', $categorization->id) }}" style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn-icon" type="submit">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
    $('#categorizations-table').DataTable({
        pageLength: 25,
        columnDefs: [
            {orderable: false, targets: 5}
        ]
    });
});
</script>
@endpush