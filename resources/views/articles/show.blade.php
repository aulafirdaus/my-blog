<x-app-layout title="{{ $article->title }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $article->title }}</h2>
                <div class="text-muted">
                    {{ $article->created_at->format('d F, Y') }}
                    Authored by {{ $article->author->name }}
                </div>
                <hr>
                {{ $article->body }}
            </div>
        </div>
    </div>
</x-app-layout>