@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $currentYear }} expenses</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        {{ $currentYear }} expenses
                        <ul class="nav nav-tabs card-header-tabs pull-right">
                            @foreach ($years as $year)
                                <li class="nav-item">
                                    <a class="nav-link @if($year->year == $currentYear) active @endif" href="{{ route('expenses.index', ['year' => $year->year]) }}">{{ $year->year }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    @each('macope::partials.billing', $expenses, 'typeCategory')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection