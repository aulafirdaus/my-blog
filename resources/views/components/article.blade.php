<div class="col-md-4">
    <div class="border rounded shadow-sm p-4">
        <h5>
            <a class="text-dark text-decoration-none" href="{{ route('articles.show', $article) }}">
                {{ $article->title }}
            </a>
        </h5>
        <small class="card-subtitle mb-2 text-muted">{{ $article->created_at->format('d F, Y') }}</small>
        <div class="d-flex align-items-center mt-2">
            <a class="text-decoration-none" href="{{ route('categories.show', $article->category) }}">{{ $article->category->name }}</a>
            <small class="mx-2 text-muted">/</small>
            @empty(!$article->tags)
            <small class="d-block">
                @foreach ($article->tags as $tag)
                    <a class="text-decoration-none" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
                @endforeach
                    </small>
                @endempty
                </div>
                <a class="btn btn-sm btn-primary mt-3 d-inline-flex align-items-center gap-2" href="{{ route('articles.show', $article) }}">
                    Read more
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                        class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147
                 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                    </svg>
                </a>
            </div>
        </div>