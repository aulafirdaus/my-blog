<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public $categories;
    public function __construct(){
        $this->middleware(['auth', 'verified'])->except(['show', 'index']);
        $this->categories = Category::select('id', 'name')->get();
    }

    public function index(){
        $articles = Article::orderBy('created_at','DESC')->get();
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article){
        return view('articles.show', [
            'article' => $article,
        ]);
    }

    public function create(){
        return view('articles.create', [
            'article' => new Article(),
            'categories' => $this->categories,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'category' => ['required', 'exists:categories,id'],
        ]);
        // $atributes['category_id'] = $request->category;
        $article = auth()->user()->articles()->create([
            'title' => $title = $request->title,
            'slug' => str($title . ' ' . str()->random(3))->slug(),
            'body' => $request->body,
            'category_id' => $request->category,
        ]);
        return to_route('articles.show', $article);
    }

    public function edit(Article $article){
        return view('articles.edit', [
            'article' => $article,
            'categories' => $this->categories,
        ]);
    }

    public function update(Request $request, Article $article){
        $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'category' => ['required', 'exists:categories,id'],
        ]);
        // $atributes['category_id'] = $request->category;
        $article->update([
            'title' => $title = $request->title,
            'slug' => str($title . ' ' . str()->random(3))->slug(),
            'body' => $request->body,
            'category_id' => $request->category,
        ]);
        return to_route('articles.show', $article->id);
    }

    public function destroy(Article $article){
        $article->delete();
        return back();
    }
}
