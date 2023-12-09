<x-app-layout title="New Article">
    <div class="container">
        <x-card class="mb-4" title="New" subtitle="Create new article">
            <form method='post' action="{{ route('articles.store') }}" enctype="multipart/form-data">
                @csrf
                @include('articles.form', ['submit' => 'Create'])
            </form>
        </x-card>
    </div>
</x-app-layout>