<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.galleries.create');
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['image'] = $request->file('image')->store('galleries', 'public');

        Gallery::create($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function edit(Gallery $galeri): View
    {
        return view('admin.galleries.edit', ['gallery' => $galeri]);
    }

    public function update(UpdateGalleryRequest $request, Gallery $galeri): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($galeri->image) {
                Storage::disk('public')->delete($galeri->image);
            }
            $validated['image'] = $request->file('image')->store('galleries', 'public');
        }

        $galeri->update($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $galeri): RedirectResponse
    {
        if ($galeri->image) {
            Storage::disk('public')->delete($galeri->image);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
