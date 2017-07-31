@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Incomes</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        Incomes
                        <ul class="nav nav-tabs card-header-tabs pull-right">
                            @foreach ($years as $year)
                                <li class="nav-item">
                                    <a class="nav-link @if($year->year == $currentYear) active @endif" href="{{ route('incomes.index', ['year' => $year->year]) }}">{{ $year->year }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    @foreach ($incomes as $year => $yearly)
                        <h2>{{ $year }}</h2>
                        <table id="incomes-table" class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Jan.</th>
                                    <th>Feb.</th>
                                    <th>Mar.</th>
                                    <th>Apr.</th>
                                    <th>May</th>
                                    <th>Jun.</th>
                                    <th>Jul.</th>
                                    <th>Aug.</th>
                                    <th>Sep.</th>
                                    <th>Oct.</th>
                                    <th>Nov.</th>
                                    <th>Dec.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($yearly as $typeCategory => $byCategories)
                                    <tr>
                                        <td class="font-weight-bold text-decoration-underline">{{ $typeCategory }}</td>
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
                                                    <td>{{ $amount['credit'] }}</td>
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
    $('#incomes-table').DataTable({
        ordering: false,
        paging: false
    });
});
</script>
@endpush