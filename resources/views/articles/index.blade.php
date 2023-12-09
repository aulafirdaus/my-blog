<x-app-layout title="Articles">
    <div class="bg-light mb-5 border-bottom py-5" style="margin-top: -24px">
        <div class="container">
            <h1>Articles</h1>
            <p class="text-muted lead">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Sit perspiciatis hic dolor.</p>
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
            <div class="alert alert-info">Tidak ada data</div>
        @endempty
    </div>
</x-app-layout>