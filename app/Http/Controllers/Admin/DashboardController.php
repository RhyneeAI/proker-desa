<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Official;
use App\Models\Umkm;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'news' => News::count(),
            'announcements' => Announcement::count(),
            'officials' => Official::count(),
            'umkms' => Umkm::count(),
            'facilities' => Facility::count(),
            'galleries' => Gallery::count(),
        ];

        $latestNews = News::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        $latestAnnouncements = Announcement::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestNews', 'latestAnnouncements'));
    }
}
