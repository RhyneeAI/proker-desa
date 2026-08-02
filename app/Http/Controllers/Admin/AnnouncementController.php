<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Traits\HasUniqueSlug;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    use HasUniqueSlug;

    public function index(): View
    {
        $announcements = Announcement::latest('published_at')->get();

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(AnnouncementRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = $this->generateUniqueSlug(Announcement::class, $validated['title']);
        $validated['user_id'] = $request->user()->id;
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        Announcement::create($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $pengumuman): View
    {
        return view('admin.announcements.edit', ['announcement' => $pengumuman]);
    }

    public function update(AnnouncementRequest $request, Announcement $pengumuman): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->boolean('is_published');

        if ($pengumuman->title !== $validated['title']) {
            $validated['slug'] = $this->generateUniqueSlug(Announcement::class, $validated['title'], $pengumuman->id);
        }

        if ($validated['is_published'] && ! $pengumuman->published_at) {
            $validated['published_at'] = now();
        }

        if (! $validated['is_published']) {
            $validated['published_at'] = null;
        }

        $pengumuman->update($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $pengumuman): RedirectResponse
    {
        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
