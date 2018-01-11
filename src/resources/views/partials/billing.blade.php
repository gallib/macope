<h2>{{ $key }}</h2>
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
                <td>{{ isset($amount['debit']) ? $amount['debit'] : $amount['credit']  }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>