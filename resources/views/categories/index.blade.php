<x-app-layout title="Categories">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">New</a>
                </div>
                <x-card title="Categories" subtitle="Table of categories">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>