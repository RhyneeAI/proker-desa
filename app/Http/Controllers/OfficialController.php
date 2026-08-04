<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\VillageProfile;
use Illuminate\View\View;

class OfficialController extends Controller
{
    public function index(): View
    {
        $profile = VillageProfile::first();

        $officials = Official::orderBy('display_order')
            ->orderBy('id')
            ->get();

        return view('public.officials.index', compact('profile', 'officials'));
    }
}
