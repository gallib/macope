@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col">
            <ul class="nav justify-content-end">
                @foreach ($years as $year)
                    <li class="nav-item">
                        <a class="nav-link @if($year->year == $currentYear) active @endif" href="{{ route('incomes.index', ['year' => $year->year]) }}">{{ $year->year }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    @each('partials.billing', $incomes, 'typeCategory')
</div>
@endsection