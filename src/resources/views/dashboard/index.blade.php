@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach ($billing as $year => $yearly)
                        <h2>{{ $year }}</h2>
                        <table class="table table-bordered table-condensed">
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
                                        <td>{{ $typeCategory }}</td>
                                        <td colspan="12"></td>
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