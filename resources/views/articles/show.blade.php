<x-app-layout title="{{ $article->title }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $article->title }}</h2>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('categories.show', $article->category) }}" class="btn btn-primary btn-sm">{{ $article->category->name }}</a>
                    <div class="text-muted">
                        {{ $article->created_at->format('d F, Y') }}
                        Authored by {{ $article->user->name }}
                    </div>
                </div>
                <hr>
                {{ $article->body }}
            </div>
        </div>
    </div>
</x-app-layout>