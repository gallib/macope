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
                    @each('macope::partials.billing', $incomes, 'typeCategory')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection