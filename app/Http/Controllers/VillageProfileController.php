<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Official;
use App\Models\Umkm;
use App\Models\VillageProfile;
use App\Models\WaterPoint;
use App\Models\Wisata;
use Illuminate\View\View;

class VillageProfileController extends Controller
{
    public function show(): View
    {
        $profile = VillageProfile::firstOrFail();

        $officials = Official::orderBy('display_order')
            ->orderBy('id')
            ->take(4)
            ->get();

        return view('public.village-profile.show', compact('profile', 'officials'));
    }

    public function map(): View
    {
        $profile = VillageProfile::firstOrFail();

        $umkms = Umkm::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        $facilities = Facility::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        $waterPoints = WaterPoint::whereNotNull('recommend_latitude')
            ->whereNotNull('recommend_longitude')
            ->latest()
            ->get();

        $wisatas = Wisata::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        return view('public.village-profile.map', compact('profile', 'umkms', 'facilities', 'waterPoints', 'wisatas'));
    }
}
