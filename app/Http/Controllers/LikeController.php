<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeComment(Request $request, Comment $comment)
    {
        $request->user()->toggleLike($comment);
        return back();
    }

    public function likeArticle(Request $request, Article $article)
    {
        $request->user()->toggleLike($article);
        return back();
    }
}
