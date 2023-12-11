<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Enums\ArticleStatus;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public $categories;
    public $tags;
    public function __construct(){
        $this->middleware(['auth','verified', 'can.write.article'])->except(['show', 'index']);
        $this->categories = Category::select('id', 'name')->get();
        $this->tags = Tag::select('id', 'name')->get();
    }

    public function table(Request $request)
    {
        $articles = Article::query()
            ->without(['category', 'tags'])
            ->when(!$request->user()->isAdmin(), fn ($query) => $query->whereBelongsTo($request->user()))
            ->latest()
            ->paginate(9);
        return view('articles.table', [
            'articles' => $articles,
        ]);
    }

    public function updateStatus(Request $request, Article $article)
    {
        $article->forceFill([
            'status' => $request->status,
            'published_at' => $request->status == ArticleStatus::PUBLISHED ? now() : null,
        ])->save();
        return back();
    }

    public function index(){
        $articles = Article::query()
            ->with(['user', 'category', 'tags'])
            ->where('status', ArticleStatus::PUBLISHED)
            ->latest()
            ->fastPaginate(9);
        // dd($articles);
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article){
        $this->authorize('viewIfOnlyAuthorOrAdmin', $article);
        $relatedArticles = Article::query()
            ->whereBelongsTo($article->category)
            ->published()
            ->whereNot('id', $article->id)
            ->latest()
            ->limit(9)
            ->get();

        $comments = Comment::query()
        ->select('user_id', 'body', 'created_at', 'id')
        ->with('user')
        ->withCount('likes')
        ->whereMorphedTo('commentable', $article)
        ->get();
        return view('articles.show', [
            'article' => $article->loadCount('likes'),
            'relatedArticles' => $relatedArticles,
            'comments' => $comments,
        ]);
    }

    public function create(){
        return view('articles.create', [
            'article' => new Article(),
            'categories' => $this->categories,
            'tags' => $this->tags,
        ]);
    }

    public function store(ArticleRequest $request){
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
        // abort_if(auth()->user()?->isNot($article->user), 401);
        $this->authorize('view', $article);
        return view('articles.edit', [
            'article' => $article,
            'categories' => $this->categories,
            'tags' => $this->tags,
        ]);
    }

    public function update(ArticleRequest $request, Article $article){
        // abort_if(auth()->user()?->isNot($article->user), 401);
        $this->authorize('update', $article);
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
        // abort_if(auth()->user()?->isNot($article->user), 401);
        $this->authorize('delete', $article);
        if ($article->picture) {
            Storage::delete($article->picture);
        }
        $article->tags()->detach();
        $article->delete();
        return to_route('articles.index');
        // return back();
    }
}
