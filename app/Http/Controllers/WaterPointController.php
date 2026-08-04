<?php

namespace App\Http\Controllers;

use App\Models\WaterPoint;
use Illuminate\View\View;

class WaterPointController extends Controller
{
    public function show(WaterPoint $titikAir): View
    {
        return view('public.water-points.show', ['waterPoint' => $titikAir]);
    }
}
