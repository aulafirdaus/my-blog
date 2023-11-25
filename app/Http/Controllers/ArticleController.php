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

    public function show($id){
        $article = Article::find($id);
        abort_if(!$article, 404);
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

    public function edit($id){
        $article = Article::find($id);
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(Request $request, $id){
        $atributes = $request->validate([
            'title' => ['required'],
            'body' => ['required'],
        ]);
        $article = Article::where('id', $id)->first();
        $article->update($atributes);
        return to_route('articles.show', $article->id);
    }

    public function destroy($id){
        Article::find($id)->delete($id);
        return back();
    }
}
