<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Official;
use App\Models\Umkm;
use App\Models\WaterPoint;
use App\Models\Wisata;
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
            'waterPoints' => WaterPoint::count(),
            'wisatas' => Wisata::count(),
        ];

        $latestNews = News::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        $latestAnnouncements = Announcement::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        $umkmByCategory = Umkm::query()
            ->selectRaw('COALESCE(NULLIF(category, ""), "Tanpa Kategori") as label, COUNT(*) as total')
            ->groupBy('label')
            ->orderByDesc('total')
            ->pluck('total', 'label');

        $waterPointByStatus = WaterPoint::query()
            ->selectRaw('COALESCE(NULLIF(status, ""), "Belum Diisi") as label, COUNT(*) as total')
            ->groupBy('label')
            ->orderByDesc('total')
            ->pluck('total', 'label');

        return view('admin.dashboard', compact(
            'stats',
            'latestNews',
            'latestAnnouncements',
            'umkmByCategory',
            'waterPointByStatus',
        ));
    }
}
