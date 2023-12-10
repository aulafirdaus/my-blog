<x-app-layout title="Edit Artikel: {{ $article->title }}">
    <div class="container">
        <x-card class="mb-4" title="Edit Artikel" subtitle="{{ $article->title }}">
            <form method='post' action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
                @method('put')
                @include('articles.form', ['submit' => 'Update'])
            </form>
        </x-card>
        <div class="text-end">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Delete
                </button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title" id="exampleModalLabel">{{ $article->title }}</div> <button type="button"
                                class="btn-close" data-bs-dismiss="modal" aria- label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted text-center">Are you really sure you want to delete
                                it?</p>
                            <div class="d-flex align-items-center gap-2 justify-content-center">
                                <form action="{{ route('articles.destroy', $article) }}" method="post"> 
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">
                                    Yes
                                    </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>