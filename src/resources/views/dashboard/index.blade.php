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
                        Latest expenses
                    </div>
                </div>
                <div class="card-body">
                    <macope-last-expenses></macope-last-expenses>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection