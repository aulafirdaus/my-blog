@csrf
<div class="mb-4">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title',$article->title) }}"
        class="form-control @error('title') is-invalid @enderror">
    @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-4">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option selected disabled>Choose one!</option>
                @foreach ($categories as $category)
                <option {{ old('category')==$category->id || $article?->category_id == $category->id ? 'selected' : '' }}
                    value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="mb-4">
        <label for="tags" class="form-label">Tags</label>
        <select name="tags[]" id="tags" class="form-control @error('tags') is-invalid @enderror" multiple>
            @foreach ($tags as $tag)
            <option {{ $article?->tags()->find($tag->id) ? 'selected' : '' }}
                value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        @error('tags')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-4">
    <label for="body" class="form-label">Body</label>
    <textarea name="body" id="body"
        class="form-control @error('title') is-invalid @enderror">{{ old('body',$article->body) }}</textarea>
    @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{ $submit }}</button>

@pushOnce('styles')
<!-- Style Select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endPushOnce
@pushOnce('scripts')
<!-- Script Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $('#tags').select2( {
        theme: 'bootstrap-5'
    } );
</script>
<!-- End Select2 -->
@endPushOnce