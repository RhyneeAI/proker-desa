<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        $facilities = Facility::latest()->get();

        return view('public.facilities.index', compact('facilities'));
    }
}
