<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public $categories;
    public $tags;
    public function __construct(){
        $this->middleware(['auth', 'verified'])->except(['show', 'index']);
        $this->categories = Category::select('id', 'name')->get();
        $this->tags = Tag::select('id', 'name')->get();
    }

    public function index(){
        $articles = Article::query()->latest()->paginate(9);
        // dd($articles);
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article){
        $relatedArticles = Article::query()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->limit(9)
            ->get();
        return view('articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }

    public function create(){
        return view('articles.create', [
            'article' => new Article(),
            'categories' => $this->categories,
            'tags' => $this->tags,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'category' => ['required', 'exists:categories,id'],
            'tags' => ['required', 'array'],
            'picture' => ['nullable', 'mimes:jpg,jpeg,png'],
        ]);
        // $atributes['category_id'] = $request->category;
        $fileRequest = $request->file('picture');
        $article = auth()->user()->articles()->create([
            'title' => $title = $request->title,
            'slug' => $slug = str($title . ' ' . str()->random(3))->slug(),
            'body' => $request->body,
            'category_id' => $request->category,
            'picture' => $request->has('picture') ? $fileRequest->storeAs('articles/images', $slug . $fileRequest->extension()) : null,
        ]);

        $article->tags()->attach($request->tags);
        return to_route('articles.show', $article);
    }

    public function edit(Article $article){
        return view('articles.edit', [
            'article' => $article,
            'categories' => $this->categories,
            'tags' => $this->tags,
        ]);
    }

    public function update(Request $request, Article $article){
        $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'category' => ['required', 'exists:categories,id'],
            'tags' => ['required', 'array'],
            'picture' => ['nullable', 'mimes:jpg,bmp,png'],
        ]);
        $fileRequest = $request->file('picture');
        $article->update([
            'title' => $title = $request->title,
            'body' => $request->body,
            'category_id' => $request->category,
            'picture' => $request->has('picture') ?
            $fileRequest->storeAs('articles/images', $article->slug . $fileRequest->extension())
            : $article->picture,
        ]);
        $article->tags()->sync($request->tags, true);
        return to_route('articles.show', $article);
    }

    public function destroy(Article $article){
        if ($article->picture) {
            Storage::delete($article->picture);
        }
        $article->tags()->detach();
        $article->delete();
        return back();
    }
}
