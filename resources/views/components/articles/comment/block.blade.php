@if ($comments->count())
@foreach ($comments as $comment)
<div class="mb-4 border-top pt-4 mt-4">
    {!! str($comment->body)->markdown() !!}
    <small class="text-muted d-flex align-items-center gap-2">
        {{ $comment->user->name }} &middot; {{ $comment->created_at->diffForHumans() }}
        &middot;
        <span>
            {{ $comment->likes_count }} {{ str('like')->plural($comment->likes_count) }}
        </span>
        @auth
        <form method="POST" action="{{ route('comments.like', $comment) }}">
            @csrf
            <a class="text-primary text-decoration-none" href="{{ route('comments.like', $comment) }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                {{ $comment->alreadyLiked() ? 'Unlike' : 'Like' }}
            </a>
        </form>
        @if (Auth::user()?->id == $comment->user_id)
        &middot; <form method="POST" action="{{ route('comments.delete', $comment) }}">
            @csrf
            @method('DELETE')
            <a class="text-danger text-decoration-none" href="{{ route('comments.delete', $comment) }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                Delete
            </a>
        </form>
        @endif
        @endauth
    </small>
</div>
@endforeach
@else
<p class="text-muted">Be the first to comment!</p>
@endif