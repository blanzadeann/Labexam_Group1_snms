<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PublicArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->where('status', 'published')
            ->latest()
            ->get();

        return response()->json($articles);
    }
}