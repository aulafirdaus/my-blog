<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(){
        $articles = DB::table('articles')->orderBy('created_at','DESC')->get();
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show($id){
        $article = DB::table('articles')->find($id);
        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required'],
            'body' => ['required']
        ]);
        DB::table('articles')->insert([
            'title' => $request->title,
            'body' => $request->body,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect('articles');
    }
}
