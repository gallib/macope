@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ old('name', $account->name) }}">
    @if ($errors->has('name'))
        <small class="form-text text-danger">
            {{ $errors->first('name') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" placeholder="Description" value="{{ old('description', $account->description) }}">
    @if ($errors->has('description'))
        <small class="form-text text-danger">
            {{ $errors->first('description') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="account_number">Account number</label>
    <input type="text" class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}" id="account_number" name="account_number" placeholder="Account number" value="{{ old('account_number', $account->account_number) }}">
    @if ($errors->has('account_number'))
        <small class="form-text text-danger">
            {{ $errors->first('account_number') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="iban">Iban</label>
    <input type="text" class="form-control {{ $errors->has('iban') ? 'is-invalid' : '' }}" id="iban" name="iban" placeholder="Iban" value="{{ old('iban', $account->iban) }}">
    @if ($errors->has('iban'))
        <small class="form-text text-danger">
            {{ $errors->first('iban') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="currency">Currency</label>
    <input type="text" class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" id="currency" name="currency" placeholder="Currency" value="{{ old('currency', $account->currency) }}">
    @if ($errors->has('currency'))
        <small class="form-text text-danger">
            {{ $errors->first('currency') }}
        </small>
    @endif
</div>
