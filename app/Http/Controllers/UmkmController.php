<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UmkmController extends Controller
{
    public function index(Request $request): View
    {
        $umkms = Umkm::when($request->filled('category'), function ($query) use ($request) {
            $query->where('category', $request->input('category'));
        })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Umkm::whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('public.umkms.index', compact('umkms', 'categories'));
    }

    public function show(Umkm $umkm): View
    {
        return view('public.umkms.show', compact('umkm'));
    }
}
