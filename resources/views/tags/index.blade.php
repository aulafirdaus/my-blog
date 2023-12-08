<x-app-layout title="Tags">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-end mb-2">
                    <a class="btn btn-primary" href="{{ route('tags.create') }}">New</a>
                </div>
                <x-card title="Tags" subtitle="Table of tags">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $index => $tag)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    <a href="{{ route('tags.edit', $tag) }}">
                                        Edit
                                    </a>
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