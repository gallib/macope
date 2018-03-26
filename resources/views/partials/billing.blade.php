<div class="d-flex">
    <h2>{{ $typeCategory['type_category']->name }}</h2>

    <div class="ml-auto">
        <a href="{{ route('type-categories.show', $typeCategory['type_category']->id) }}" title="View details">
            <i class="fa fa-eye"></i>
        </a>
    </div>
</div>

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
    @foreach ($typeCategory['categories'] as $category)
        <tr>
            <td>{{ $category['category']->name }}</td>
            @foreach ($category['months'] as $month => $amount)
                <td>{{ $amount  }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>