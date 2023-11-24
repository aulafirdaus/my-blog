<x-app-layout title="Articles">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @forelse($articles as $article)
                <x-card class="mb-4" title="{{ $article->title }}" subtitle="{{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}">
                    {!! $article->body !!}
                    <div class="mt-2"><a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Read more</a></div>
                </x-card>
                @empty
                <div class="container">
                    <div class="alert alert-info">Tidak ada artikel yang ditemukan</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>