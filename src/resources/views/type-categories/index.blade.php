@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Type categories</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('macope::helpers.form-message')
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('type-categories.create') }}" title="Add a type category" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                                        <td>
                                            <a href="{{ route('type-categories.show', $typeCategory->id) }}" title="View details">{{ $typeCategory->name }}</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('type-categories.edit', $typeCategory->id) }}">Edit</a>
                                            @if ($typeCategory->categories()->count() === 0)
                                                {{ Form::open(['method' => 'DELETE','route' => ['type-categories.destroy', $typeCategory->id], 'style'=>'display:inline']) }}
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
    $('#type-categories-table').DataTable({
        pageLength: 25
    });
});
</script>
@endpush