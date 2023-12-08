@csrf
<div class="mb-4">
    <label for="name" class="form-label">Name</label>
    <input type="text" value="{{ old('name', $tag->name) }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{ $submit }}</button>