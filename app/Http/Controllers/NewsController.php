<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::whereNotNull('published_at')
            ->whereNull('archived_at')
            ->orderBy('published_at', 'DESC')
            ->get()
            ->map(function ($n) {
                $n->content = substr(strip_tags($n->content), 0, 300);
                return $n;
            });

        return view('news', ['news' => $news]);
    }

    public function getNewsPage($id)
    {
        $news = News::find($id);
        if ($news) {
            return view('news_page', ['news' => $news]);
        }

    }
}
