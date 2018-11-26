@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ old('name', $typeCategory->name) }}">
    @if ($errors->has('name'))
        <small class="form-text text-danger">
            {{ $errors->first('name') }}
        </small>
    @endif
</div>
