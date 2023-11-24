<x-app-layout title="Articles">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @forelse($articles as $article)
                <x-card class="mb-4" title="{{ $article->title }}" subtitle="{{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}">
                    {!! $article->body !!}
                    <div class="mt-2 d-flex align-items-center justify-content-between gap-2">
                        <div>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Read more</a>
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-success">Edit</a>
                        </div>
                        <form action="{{ route('articles.delete', $article->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </x-card>
                @empty
                <div class="container">
                    <div class="alert alert-info">Tidak ada artikel yang ditemukan</div>
                </div>
                @endforelse
            </div>
            <div class="col-md-4">
                <a href="{{ route('articles.create') }}" class="btn btn-primary w-100">
                Create Article</a>
            </div>
        </div>
    </div>
</x-app-layout>