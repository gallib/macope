@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.breadcrumbs')
    <div class="row">
        <nav class="col">
            <ul class="nav justify-content-end">
                @foreach ($years as $year)
                    <li class="nav-item">
                        <a class="nav-link @if($year->year == $currentYear) active @endif" href="{{ route('expenses.index', ['year' => $year->year]) }}">{{ $year->year }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    @each('partials.billing', $expenses, 'typeCategory')
</div>
@endsection