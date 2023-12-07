<x-app-layout title="New Category">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card title="New" subtitle="Create new category">
                    <form method="post" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </x-card>
            </div>
            <div class="col-md-4">
                <a href="{{ route('categories.index') }}" class="btn btn-primary w-100">
                    Table of Categories
                </a>
            </div>
        </div>
    </div>
</x-app-layout>