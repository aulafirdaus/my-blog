<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $attributes = $request->validate([
            'body' => ['required'],
        ]);
        $request->user()->comments()->save(
            $article->comments()->make($attributes)
        );
        return back();
    }

    public function destroy(Request $request, Comment $comment)
    {
        abort_if(
            $comment->user_id != $request->user()?->id,
            403,
            'You are not authorized.'
        );
        $comment->delete();
        return back();
    }
}
