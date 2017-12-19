@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $currentYear }} incomes</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        {{ $currentYear }} incomes
                        <ul class="nav nav-tabs card-header-tabs pull-right">
                            @foreach ($years as $year)
                                <li class="nav-item">
                                    <a class="nav-link @if($year->year == $currentYear) active @endif" href="{{ route('incomes.index', ['year' => $year->year]) }}">{{ $year->year }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($incomes as $typeCategory => $byCategories)
                        <h2>{{ $typeCategory }}</h2>
                        <table class="table table-bordered table-condensed">
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
                                @foreach ($byCategories as $category => $monthly)
                                    <tr>
                                        <td>{{ $category }}</td>
                                        @foreach ($monthly as $month => $amount)
                                            <td>{{ $amount['credit'] }}</td>
                                        @endforeach
                                    </tr>
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