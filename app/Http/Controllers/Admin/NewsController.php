<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Traits\HasUniqueSlug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    use HasUniqueSlug;

    public function index(): View
    {
        $newsList = News::latest('published_at')->get();

        return view('admin.news.index', compact('newsList'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = $this->generateUniqueSlug(News::class, $validated['title']);
        $validated['user_id'] = $request->user()->id;
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
        }

        News::create($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $berita): View
    {
        return view('admin.news.edit', ['news' => $berita]);
    }

    public function update(NewsRequest $request, News $berita): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->boolean('is_published');

        if ($berita->title !== $validated['title']) {
            $validated['slug'] = $this->generateUniqueSlug(News::class, $validated['title'], $berita->id);
        }

        if ($validated['is_published'] && ! $berita->published_at) {
            $validated['published_at'] = now();
        }

        if (! $validated['is_published']) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
        }

        $berita->update($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function togglePublish(News $berita): RedirectResponse
    {
        $berita->update([
            'is_published' => ! $berita->is_published,
            'published_at' => $berita->is_published ? null : now(),
        ]);

        $status = $berita->is_published ? 'diterbitkan' : 'diturunkan';

        return back()->with('success', "Berita berhasil {$status}.");
    }

    public function destroy(News $berita): RedirectResponse
    {
        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
