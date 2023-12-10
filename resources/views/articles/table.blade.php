<x-app-layout title="Table of Articles">
    <div class="container">
        <x-card title="Table of Articles" subtitle="Do anything here, because you're the super
admin!">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Created at</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $articles->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('articles.show', $article) }}">
                                {{ $article->title }}
                            </a>
                        </td>
                        <td>
                            <span class="badge {{ $article->status->name === 'PUBLISHED' ? 'bg-success' : 'bg-danger' }}">
                                {{ $article->status->name }}
                            </span>
                        </td>
                        <td>{{ $article->user->name }}</td>
                        <td>{{ $article->created_at->format('d F, Y') }}</td>
                        @hasRole('admin')
                        <td>
                            <x-table.dropdown-menu>
                                @if ($article->status == \App\Enums\ArticleStatus::PENDING)
                                <li>
                                    <form method="POST" action="{{ route('articles.update-status', $article) }}">
                                        @csrf 
                                        @method('put')
                                        <input type="hidden" name="status" value="{{ \App\Enums\ArticleStatus::PUBLISHED->value }}">
                                        <a class="dropdown-item" href="{{ route('articles.update-status', $article) }}"
                                            onclick="event.preventDefault();this.closest('form').submit();">
                                            Approve
                                        </a>
                                    </form>
                                </li>
                                @endif
                                @if ($article->status == \App\Enums\ArticleStatus::PUBLISHED)
                                <li>
                                    <form method="POST" action="{{ route('articles.update-status', $article) }}">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="status" value="{{ \App\Enums\ArticleStatus::PENDING->value }}">
                                        <a class="dropdown-item" href="{{ route('articles.update-status', $article) }}"
                                            onclick="event.preventDefault();this.closest('form').submit();">
                                            Take down
                                        </a>
                                    </form>
                                </li>
                                @endif
                            </x-table.dropdown-menu>
                            @endHasRole
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $articles->links() }}
        </x-card>
    </div>
</x-app-layout>