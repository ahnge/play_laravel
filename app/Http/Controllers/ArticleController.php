<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;

class ArticleController extends Controller
{

    // The auth middleware enables the authorization feature.
    // You need to be authenticated to be able to view all routes exvept(...)
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view('articles.index', [
            'articles' => $data
        ]);
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view('articles.detail', [
            'article' => $data
        ]);
    }

    public function add()
    {
        $data = Category::all();
        return view('articles.add', [
            'categories' => $data
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);

        # Ensure the user owns the record
        if (Gate::denies('article-modify', $article)) {
            return back()->with('error', 'Unauthorize');
        }

        $article->delete();

        return redirect('/articles')->with('info', 'Article deleted');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        # Ensure the user owns the record
        if (Gate::denies('article-modify', $article)) {
            return back()->with('error', 'Unauthorize');
        }

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function edited($id)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = Article::find($id);
        # Ensure the user owns the record
        if (Gate::denies('article-modify', $article)) {
            return back()->with('error', 'Unauthorize');
        }

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles')->with('info', 'Article Edited');
    }
};
