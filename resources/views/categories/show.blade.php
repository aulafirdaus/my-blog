<x-app-layout title="Articles category: {{ $category->name }}">
    <div class="bg-light mb-5 border-bottom py-5" style="margin-top: -24px">
        <div class="container">
            <h1>{{ $category->name }}</h1>
            <p class="text-muted lead">This page will show all articles by {{ $category->name }} category.</p>
        </div>
    </div>
    <div class="container">
        @empty(!$articles)
        @foreach ($articles->chunk(3) as $chunk)
        <div class="row mb-4">
            @foreach ($chunk as $article)
                <x-article :article="$article" />
            @endforeach
        </div>
        @endforeach
        {{ $articles->links() }}
        @else
            <div class="alert alert-info">No articles for now.</div>
        @endempty
    </div>
</x-app-layout>