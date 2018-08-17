@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ old('name', $category->name) }}">
    @if ($errors->has('name'))
        <small class="form-text text-danger">
            {{ $errors->first('name') }}
        </small>
    @endif
</div>
<div class="form-group">
    <label for="type_category_id">Type category</label>
    <select class="form-control {{ $errors->has('type_category_id') ? 'is-invalid' : '' }}" id="type_category_id" name="type_category_id">
        @foreach($typeCategories as $key => $display)
            <option value="{{ $key }}" {{ old('type_category_id', $category->type_category_id) == $key ? 'selected="selected"' : '' }}>{{ $display }}</option>
        @endforeach
    </select>
    @if ($errors->has('type_category_id'))
        <small class="form-text text-danger">
            {{ $errors->first('type_category_id') }}
        </small>
    @endif
</div>
<div class="form-group">
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" id="is_ignored" name="is_ignored" value="1" class="form-check-input" {{ old('is_ignored', $category->is_ignored) == '1' ? 'checked="checked"' : '' }}> Ignore this category
        </label>
    </div>
</div>
