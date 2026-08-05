<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeroSlideRequest;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(): View
    {
        $heroSlides = HeroSlide::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.heroes.index', compact('heroSlides'));
    }

    public function create(): View
    {
        return view('admin.heroes.create');
    }

    public function store(HeroSlideRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('heroes', 'public');
        }

        $validated['active'] = $request->boolean('active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        HeroSlide::create($validated);

        return redirect()
            ->route('admin.hero.index')
            ->with('success', 'Slide hero berhasil ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide): View
    {
        return view('admin.heroes.edit', compact('heroSlide'));
    }

    public function update(HeroSlideRequest $request, HeroSlide $heroSlide): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($heroSlide->image) {
                Storage::disk('public')->delete($heroSlide->image);
            }
            $validated['image'] = $request->file('image')->store('heroes', 'public');
        }

        $validated['active'] = $request->boolean('active');
        $validated['sort_order'] = $validated['sort_order'] ?? $heroSlide->sort_order;

        $heroSlide->update($validated);

        return redirect()
            ->route('admin.hero.index')
            ->with('success', 'Slide hero berhasil diperbarui.');
    }

    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        if ($heroSlide->image) {
            Storage::disk('public')->delete($heroSlide->image);
        }

        $heroSlide->delete();

        return redirect()
            ->route('admin.hero.index')
            ->with('success', 'Slide hero berhasil dihapus.');
    }
}
