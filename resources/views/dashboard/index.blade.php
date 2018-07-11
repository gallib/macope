@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row mb-4">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $currentMonthExpenses }}</h4>
                    <p>expenses this month</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $lastMonthIncomes }}</h4>
                    <p>incomes last month</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $entryToCategorize }}</h4>
                    <p>{{ str_plural('entry', $entryToCategorize) }} to categorize</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sum of expenses/incomes by month</h5>
                    <entries-sum-by-month></entries-sum-by-month>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Average of expenses by type category</h5>
                    <h6 class="card-subtitle mb-2 text-muted">on last 12 months</h6>
                    <expenses-by-type-category></expenses-by-type-category>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection