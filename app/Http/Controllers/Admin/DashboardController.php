<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Facility;
use App\Models\News;
use App\Models\PageVisit;
use App\Models\Umkm;
use App\Models\WaterPoint;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'facilities' => Facility::count(),
            'umkms' => Umkm::count(),
            'waterPoints' => WaterPoint::count(),
            'news' => News::count(),
        ];

        $visits = PageVisit::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $dates = collect(range(29, 0))->map(fn ($i) => now()->subDays($i)->toDateString());
        $chartLabels = $dates->map(fn ($d) => Carbon::parse($d)->translatedFormat('d M'));
        $chartData = $dates->map(fn ($d) => $visits->get($d, 0));

        $todayVisits = PageVisit::whereDate('created_at', today())->count();
        $todayUnique = PageVisit::whereDate('created_at', today())->distinct('ip')->count('ip');
        $totalVisits = PageVisit::count();

        $latestAnnouncements = Announcement::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'chartLabels',
            'chartData',
            'todayVisits',
            'todayUnique',
            'totalVisits',
            'latestAnnouncements',
        ));
    }
}
