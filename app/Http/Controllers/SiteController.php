<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Models\Service;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'services' => Service::query()->orderBy('sort_order')->get(),
            'posts' => Post::query()->where('is_published', true)->latest('published_at')->take(3)->get(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function services(): View
    {
        return view('services.index', [
            'services' => Service::query()->orderBy('sort_order')->get(),
        ]);
    }

    public function serviceShow(Service $service): View
    {
        return view('services.show', compact('service'));
    }

    public function blog(): View
    {
        return view('blog.index', [
            'posts' => Post::query()->where('is_published', true)->latest('published_at')->paginate(9),
        ]);
    }

    public function blogShow(Post $post): View
    {
        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(KnowledgeArticle $article): View
    {
        return view('kb.show', compact('article'));
    }
}
