<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::where('is_published', true)
            ->latest('published_at')
            ->paginate(10);

        return view('public.announcements.index', compact('announcements'));
    }

    public function show(string $slug): View
    {
        $announcement = Announcement::where('is_published', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.announcements.show', compact('announcement'));
    }
}
