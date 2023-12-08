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