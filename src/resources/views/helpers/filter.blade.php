{{ Form::open(['url' => route('journal'), 'class' => 'form-inline', 'method' => 'get']) }}
<div class="form-group">
    {{ Form::label('account', 'Account') }}
    {{ Form::select('account', $accounts, $account, ['class' => 'form-control']) }}
</div>
{{ Form::submit('Filter', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}