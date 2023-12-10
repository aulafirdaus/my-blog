<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        $articles = Article::query()
            ->latest()
            ->where('status', \App\Enums\ArticleStatus::PUBLISHED)
            ->limit(6)
            ->get();
        return view('home', [
            'articles' => $articles,
        ]);
    }
}
