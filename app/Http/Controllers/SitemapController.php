<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\News;
use App\Models\Potential;
use App\Models\Umkm;
use App\Models\Wisata;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $news = News::where('is_published', true)->latest('published_at')->get();
        $announcements = Announcement::where('is_published', true)->latest('published_at')->get();
        $umkms = Umkm::latest()->get();
        $potentials = Potential::latest()->get();
        $wisatas = Wisata::latest()->get();

        $content = view('sitemap', compact('news', 'announcements', 'umkms', 'potentials', 'wisatas'))->render();

        return response('<?xml version="1.0" encoding="UTF-8"?>' . $content)
            ->header('Content-Type', 'application/xml');
    }
}
