<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Facility;
use App\Models\News;
use App\Models\Umkm;
use App\Models\VillageProfile;
use App\Models\WaterPoint;
use App\Models\Wisata;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = VillageProfile::first();

        $latestNews = News::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestAnnouncements = Announcement::where('is_published', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        $umkms = Umkm::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        $facilities = Facility::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        $waterPoints = WaterPoint::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        $wisatas = Wisata::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        return view('public.home', compact(
            'profile',
            'latestNews',
            'latestAnnouncements',
            'umkms',
            'facilities',
            'waterPoints',
            'wisatas',
        ));
    }
}
