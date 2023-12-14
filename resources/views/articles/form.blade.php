@csrf
<div class="row">
    <div class="col-md-4">
        {{-- <div class="mb-2">
            <input class="form-control" name="picture" type="file" id="picture">
        </div> --}}
        <div class="mb-2">
            <label for="picture" class="form-label">Bukti Pembayaran</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input type="file" id="picture" name="picture" accept=".jpg,.jpeg,.png" onchange="previewImage()"
                class="form-control @error('picture') is-invalid @enderror" required>
            @error('picture')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option selected disabled>Choose category</option>
                @foreach ($categories as $category)
                <option {{ old('category')==$category->id || $article?->category_id == $category->id ? 'selected' : ''
                    }}
                    value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <select name="tags[]" id="tags" class="form-control @error('tags') is-invalid @enderror" multiple>
                @foreach ($tags as $tag)
                <option {{ $article?->tags()->find($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">
                    {{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-8">
        <div class="mb-2">
            <input type="text" placeholder="Title of article..." name="title" id="title"
                value="{{ old('title', $article->title) }}" class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <textarea style="resize: none" placeholder="The article content goes here..." rows="15" name="body"
                id="body"
                class="form-control @error('body') is-invalid @enderror">{{ old('body', $article->body) }}</textarea>
            @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ $submit }}</button>
        </div>
    </div>
</div>

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
<script>
    function previewImage() {
        const image = document.querySelector('#picture');
        const imgPreview = document.querySelector('.img-preview');
        
        imgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        
        oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
        }
        };
</script>
@endPushOnce