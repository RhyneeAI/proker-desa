<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $galleries = Gallery::when($request->filled('category'), function ($query) use ($request) {
            $query->where('category', $request->input('category'));
        })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('public.galleries.index', compact('galleries'));
    }
}
