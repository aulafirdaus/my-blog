<x-app-layout title="Edit Artikel: {{ $article->title }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card class="mb-4" title="Edit Artikel" subtitle="{{ $article->title }}">
                    <form method='post' action="{{ route('articles.update', $article->id) }}">
                        @method('put')
                        @include('articles.form', ['submit' => 'Update'])
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>