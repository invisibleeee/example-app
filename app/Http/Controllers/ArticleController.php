<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index()
    {
        $articles = Article::latest('created_at')->get();

        return view('articles.index', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        $tags = DB::table('tags')->pluck('name', 'id');
        return view('articles.create', ['tags' => $tags]);
    }

    public function store(ArticleRequest $request)
    {
        $this->createArticle($request);
        return redirect('articles')->with(['flash_message' => 'Статья успешно добавлена']);
    }

    public function edit(Article $article)
    {
        $tags = DB::table('tags')->pluck('name', 'id');
        return view('articles.edit', ['article' => $article, 'tags' => $tags]);
    }

    public function update(Article $article, ArticleRequest $request)
    {
        $article->update($request->all());
        $this->syncTags($article, $request->input('tags'));
        return redirect('articles');
    }

    private function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }

    private function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());
        $this->syncTags($article, $request->input('tags'));

        return $article;
    }
}
