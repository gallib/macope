@csrf
<div class="form-group">
    <label for="search">Search</label>
    <input type="text" class="form-control {{ $errors->has('search') ? 'is-invalid' : '' }}" id="search" name="search" placeholder="Search" value="{{ old('search', $categorization->search) }}">
    @if ($errors->has('search'))
        <small class="form-text text-danger">
            {{ $errors->first('search') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="search_type">Search type</label>
    <select class="form-control {{ $errors->has('search_type') ? 'is-invalid' : '' }}" id="search_type" name="search_type">
        @foreach($categorization->getSearchTypes() as $type)
            <option value="{{ $type }}" {{ old('search_type', $categorization->search_type) == $type ? 'selected="selected"' : '' }}>{{ $type }}</option>
        @endforeach
    </select>
    @if ($errors->has('search_type'))
        <small class="form-text text-danger">
            {{ $errors->first('search_type') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="entry_type">Entry type</label>
    <select class="form-control {{ $errors->has('entry_type') ? 'is-invalid' : '' }}" id="entry_type" name="entry_type">
        @foreach($categorization->getEntryTypes() as $type)
            <option value="{{ $type }}" {{ old('search_type', $categorization->entry_type) == $type ? 'selected="selected"' : '' }}>{{ $type }}</option>
        @endforeach
    </select>
    @if ($errors->has('entry_type'))
        <small class="form-text text-danger">
            {{ $errors->first('entry_type') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" id="amount" name="amount" placeholder="Amount" value="{{ old('amount', $categorization->amount) }}">
    @if ($errors->has('amount'))
        <small class="form-text text-danger">
            {{ $errors->first('amount') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="category_id">Category</label>
    <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" id="category_id" name="category_id">
        @foreach($categories as $key => $display)
            <option value="{{ $key }}" {{ old('category_id', $categorization->category_id) == $key ? 'selected="selected"' : '' }}>{{ $display }}</option>
        @endforeach
    </select>
    @if ($errors->has('category_id'))
        <small class="form-text text-danger">
            {{ $errors->first('category_id') }}
        </small>
    @endif
</div>