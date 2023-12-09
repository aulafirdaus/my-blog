<x-app-layout title="{{ $article->title }} | Articles">
    <div class="bg-light mb-5 border-bottom py-5" style="margin-top: -24px">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="display-4 fw-semibold">{{ $article->title }}</h1>
                    <p class="text-muted lead">{{ str($article->body)->limit(160, '.') }}</p>
                    <div class="d-flex align-items-center justify-content-between mt-5">
                        <div class="d-flex align-items-center gap-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('categories.show', $article->category) }}">{{ $article->category->name }}</a>
                                @foreach ($article->tags as $tag)
                                    <a class="btn btn-secondary btn-sm" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
                                @endforeach
                        </div>
                            <div class=" text-muted">
                                {{ $article->created_at->format('d F, Y') }} by {{ $article->user->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {{ $article->body }}
                </div>
        </div>
    </div>
</x-app-layout>