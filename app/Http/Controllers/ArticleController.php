<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        if (empty($searchQuery)) {
            return redirect()->route('articles.index');
        }

        $articles = Article::with('category')
                           ->where('title', 'LIKE', "%{$searchQuery}%")
                           ->orWhere('author_email', 'LIKE', "%{$searchQuery}%")
                           ->orWhere('body', 'LIKE', "%{$searchQuery}%")
                           ->latest()
                           ->get();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'body' => 'required',
            'author_email' => 'required|email',
            'image_url' => 'nullable|url',
            'status' => 'required|in:published,draft',
        ]);

        Article::create($validated);

        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'body' => 'required',
            'author_email' => 'required|email',
            'image_url' => 'nullable|url',
            'status' => 'required|in:published,draft',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    /**
     * Developer 7 Task: Publish article feature
     * Updates the status of a specific article to 'published'
     */
    public function publish(Article $article)
    {
        $article->update(['status' => 'published']);

        return redirect()->route('articles.index')
            ->with('success', 'Article has been published!');
    }
}