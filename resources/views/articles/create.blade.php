<x-app-layout title="New Article">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card class="mb-4" title="New" subtitle="Create new article">
                    <form method='post' action="{{ route('articles.store') }}">
                        @csrf
                        @include('articles.form', ['submit' => 'Create'])
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>