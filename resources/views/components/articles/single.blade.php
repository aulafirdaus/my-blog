<div class="col-md-4">
    <div class="border rounded overflow-hidden">
        <a href="{{ route('articles.show', $article) }}">
            <img class="w-100" src="{{ $article->picture ? asset('storage/' . $article->picture) : 'https://via.placeholder.com/1280x720' }}" alt="">
        </a>
        <div class="p-4 bg-light">
            <small class="d-flex align-items-center justify-content-between mb-2 ">
                <small class="text-muted">{{ $article->created_at->format('d F, Y') }}</small>
                <a href="{{ route('users.show', $article->user) }}" class="text-muted text-decoration-none">
                    {{ $article->user->name }}
                </a>
            </small>
                <a class="d-block font-semibold text-dark text-decoration-none" href="{{ route('articles.show', $article) }}">
                    {{ $article->title }}
                </a>
            <div class="d-flex align-items-center mt-2">
                <a class="text-decoration-none" href="{{ route('categories.show', $article->category) }}">{{
                    $article->category->name }}</a>
                <small class="mx-2 text-muted">/</small>
                @empty(!$article->tags)
                <small class="d-block">
                    @foreach ($article->tags as $tag)
                    <a class="text-decoration-none" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
                    @endforeach
                </small>
                @endempty
            </div>
        </div>
    </div>
</div>