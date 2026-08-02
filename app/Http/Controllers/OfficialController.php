<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\View\View;

class OfficialController extends Controller
{
    public function index(): View
    {
        $officials = Official::orderBy('display_order')
            ->orderBy('id')
            ->get();

        return view('public.officials.index', compact('officials'));
    }
}
