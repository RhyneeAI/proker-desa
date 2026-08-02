<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\View\View;

class WisataController extends Controller
{
    public function index(): View
    {
        $wisatas = Wisata::latest()->paginate(9);

        return view('public.wisatas.index', compact('wisatas'));
    }

    public function show(Wisata $wisata): View
    {
        return view('public.wisatas.show', compact('wisata'));
    }
}
