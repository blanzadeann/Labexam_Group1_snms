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
        return response()->json($articles);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        if (empty($searchQuery)) {
            return response()->json(['message' => 'Query is empty'], 400);
        }

        $articles = Article::with('category')
            ->where('title', 'LIKE', "%{$searchQuery}%")
            ->orWhere('author_email', 'LIKE', "%{$searchQuery}%")
            ->orWhere('body', 'LIKE', "%{$searchQuery}%")
            ->latest()
            ->get();

        return response()->json($articles);
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

        $article = Article::create($validated);

        return response()->json([
            'message' => 'Article created successfully',
            'data' => $article
        ], 201);
    }

    public function show(Article $article)
    {
        return response()->json($article->load('category'));
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

        return response()->json([
            'message' => 'Article updated successfully',
            'data' => $article
        ]);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully']);
    }

    public function publish(Article $article)
    {
        $article->update(['status' => 'published']);

        return response()->json([
            'message' => 'Article has been published!',
            'data' => $article
        ]);
    }
}