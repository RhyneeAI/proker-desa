<?php

namespace App\Http\Controllers;

use App\Models\Potential;
use Illuminate\View\View;

class PotentialController extends Controller
{
    public function index(): View
    {
        $potentials = Potential::latest()->paginate(9);

        return view('public.potentials.index', compact('potentials'));
    }

    public function show(Potential $potential): View
    {
        return view('public.potentials.show', compact('potential'));
    }
}
