@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Yearly billing
                    </div>
                </div>
                <div class="card-block">
                    @foreach ($billing as $year => $yearly)
                        <h2>{{ $year }}</h2>
                        <table id="yearly-billing-table" class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>January</th>
                                    <th>February</th>
                                    <th>March</th>
                                    <th>April</th>
                                    <th>May</th>
                                    <th>June</th>
                                    <th>July</th>
                                    <th>August</th>
                                    <th>September</th>
                                    <th>October</th>
                                    <th>November</th>
                                    <th>December</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($yearly as $typeCategory => $byCategories)
                                    <tr>
                                        <td class="font-weight-bold text-decoration-underline">{{ $typeCategory }}</td>
                                        <!--<td colspan="12"></td>-->
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                        @foreach ($byCategories as $category => $monthly)
                                            <tr>
                                                <td>{{ $category }}</td>
                                                @foreach ($monthly as $month => $amount)
                                                    <td>{{ $amount['debit'] }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#yearly-billing-table').DataTable({
        ordering: false,
        paging: false
    });
});
</script>
@endpush