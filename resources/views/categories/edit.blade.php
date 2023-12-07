<x-app-layout title="Edit category: {{ $category->name }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card title="Edit" subtitle="Edit category: {{ $category->name }}">
                    <form action="post" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('put')
                        <div class="mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ old('name', $category->name) }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </x-card>
            </div>
            <div class="col-md-4">
                <a href="{{ route('categories.index') }}" class="btn btn-primary w-100">Table of categories</a>

                <button type="button" class="btn btn-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Delete
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Category: {{ $category->name }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted text-center">Are you really sure you want to delete it?</p>
                                <div class="d-flex align-items-center gap-2 justify-content-center">
                                    <form action="{{ route('categories.destroy', $category) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>