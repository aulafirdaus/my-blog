<x-app-layout title="New tag">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card title="New" subtitle="Create new tag">
                    <form method='post' action="{{ route('tags.store') }}">
                        @include('tags.form', ['submit' => 'Create'])
                    </form>
                </x-card>
            </div>
            <div class="col-md-4">
                <a class="btn btn-primary w-100" href="{{ route('tags.index') }}">
                    Table of tags
                </a>
            </div>
        </div>
    </div>
</x-app-layout>