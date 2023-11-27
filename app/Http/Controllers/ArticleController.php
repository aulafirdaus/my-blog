<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::orderBy('created_at','DESC')->get();
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article){
        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        $atributes = $request->validate([
            'title' => ['required'],
            'body' => ['required']
        ]);
        Article::create($atributes);
        return redirect('articles');
    }

    public function edit(Article $article){
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(Request $request, Article $article){
        $atributes = $request->validate([
            'title' => ['required'],
            'body' => ['required'],
        ]);
        $article->update($atributes);
        return to_route('articles.show', $article->id);
    }

    public function destroy(Article $article){
        $article->delete();
        return back();
    }
}
