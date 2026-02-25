<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleStatsController extends Controller
{
    public function index()
    {
        $total = Article::count();
        $published = Article::where('status', 'published')->count();
        $draft = Article::where('status', 'draft')->count();

        $byCategory = Article::selectRaw('category_id, COUNT(*) as total')
            ->groupBy('category_id')
            ->with('category:id,name')
            ->get()
            ->map(fn ($row) => [
                'category_id' => $row->category_id,
                'category_name' => optional($row->category)->name,
                'total' => (int) $row->total,
            ]);

        return response()->json([
            'data' => [
                'total_articles' => (int) $total,
                'published_articles' => (int) $published,
                'draft_articles' => (int) $draft,
                'by_category' => $byCategory,
            ],
        ]);
    }
}