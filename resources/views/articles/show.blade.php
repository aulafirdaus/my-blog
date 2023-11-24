<x-app-layout title="{{ $article->title }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $article->title }}</h2>
                <div class="text-muted">
                    {{ \Carbon\Carbon::parse($article->created_at)->format('d F, Y') }}
                </div>
                <hr>
                {{ $article->body }}
            </div>
        </div>
    </div>
</x-app-layout>