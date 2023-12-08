<x-app-layout title="{{ $article->title }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $article->title }}</h2>
                <div class="text-muted">
                    {{ $article->created_at->format('d F, Y') }}
                    Authored by {{ $article->user->name }}
                </div>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <a href="{{ route('categories.show', $article->category) }}" class="btn btn-primary btn-sm">{{ $article->category->name }}</a>
                    @foreach ($article->tags as $tag)
                        <a class="btn btn-secondary btn-sm" href="{{ route('tags.show', $tag) }}">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
                <hr>
                {{ $article->body }}
            </div>
        </div>
    </div>
</x-app-layout>