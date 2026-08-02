<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $newsList = News::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('public.news.index', compact('newsList'));
    }

    public function show(string $slug): View
    {
        $news = News::where('is_published', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedNews = News::where('is_published', true)
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.news.show', compact('news', 'relatedNews'));
    }
}
