<form method="POST" action="{{ route('journal.update', $journal->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="date">Date</label>
            <input type="text" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" placeholder="Date" value="{{ old('date', $journal->date) }}">
            @if ($errors->has('date'))
                <small class="form-text text-danger">
                    {{ $errors->first('date') }}
                </small>
            @endif
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea name="text" class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" id="text">{{ old('text', $journal->text) }}</textarea>
            @if ($errors->has('text'))
                <small class="form-text text-danger">
                    {{ $errors->first('text') }}
                </small>
            @endif
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" id="category_id" name="category_id">
                <option value="">No category</option>
                @foreach($categories as $key => $display)
                    <option value="{{ $key }}" {{ old('category_id', $journal->category_id) == $key ? 'selected="selected"' : '' }}>{{ $display }}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <small class="form-text text-danger">
                    {{ $errors->first('category_id') }}
                </small>
            @endif
        </div>
        <div class="form-group">
            <label for="credit">Credit</label>
            <input type="text" class="form-control {{ $errors->has('credit') ? 'is-invalid' : '' }}" id="credit" name="credit" placeholder="Credit" value="{{ old('credit', $journal->credit) }}">
            @if ($errors->has('credit'))
                <small class="form-text text-danger">
                    {{ $errors->first('credit') }}
                </small>
            @endif
        </div>
        <div class="form-group">
            <label for="debit">Debit</label>
            <input type="text" class="form-control {{ $errors->has('debit') ? 'is-invalid' : '' }}" id="debit" name="debit" placeholder="Debit" value="{{ old('debit', $journal->debit) }}">
            @if ($errors->has('debit'))
                <small class="form-text text-danger">
                    {{ $errors->first('debit') }}
                </small>
            @endif
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Edit">
    </form>