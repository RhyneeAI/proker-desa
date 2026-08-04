<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WaterPointRequest;
use App\Models\WaterPoint;
use App\Traits\HasUniqueSlug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WaterPointController extends Controller
{
    use HasUniqueSlug;
    public function index(): View
    {
        $waterPoints = WaterPoint::latest()->get();

        return view('admin.water-points.index', compact('waterPoints'));
    }

    public function create(): View
    {
        return view('admin.water-points.create');
    }

    public function store(WaterPointRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = $this->generateUniqueSlug(WaterPoint::class, $validated['name']);

        if ($request->hasFile('documentation_photos')) {
            $validated['documentation_photos'] = collect($request->file('documentation_photos'))
                ->map(fn ($file) => $file->store('water-points', 'public'))
                ->values()
                ->all();
        }

        if ($request->hasFile('interpretation_photos')) {
            $validated['interpretation_photos'] = collect($request->file('interpretation_photos'))
                ->map(fn ($file) => $file->store('water-points', 'public'))
                ->values()
                ->all();
        }

        WaterPoint::create($validated);

        return redirect()
            ->route('admin.titik-air.index')
            ->with('success', 'Titik air berhasil ditambahkan.');
    }

    public function edit(WaterPoint $waterPoint): View
    {
        return view('admin.water-points.edit', compact('waterPoint'));
    }

    public function update(WaterPointRequest $request, WaterPoint $waterPoint): RedirectResponse
    {
        $validated = $request->validated();

        if ($waterPoint->name !== $validated['name']) {
            $validated['slug'] = $this->generateUniqueSlug(WaterPoint::class, $validated['name'], $waterPoint->id);
        }

        if ($request->hasFile('documentation_photos')) {
            collect($waterPoint->documentation_photos ?? [])->each(fn ($path) => Storage::disk('public')->delete($path));
            $validated['documentation_photos'] = collect($request->file('documentation_photos'))
                ->map(fn ($file) => $file->store('water-points', 'public'))
                ->values()
                ->all();
        }

        if ($request->hasFile('interpretation_photos')) {
            collect($waterPoint->interpretation_photos ?? [])->each(fn ($path) => Storage::disk('public')->delete($path));
            $validated['interpretation_photos'] = collect($request->file('interpretation_photos'))
                ->map(fn ($file) => $file->store('water-points', 'public'))
                ->values()
                ->all();
        }

        $waterPoint->update($validated);

        return redirect()
            ->route('admin.titik-air.index')
            ->with('success', 'Titik air berhasil diperbarui.');
    }

    public function destroy(WaterPoint $waterPoint): RedirectResponse
    {
        collect($waterPoint->documentation_photos ?? [])->each(fn ($path) => Storage::disk('public')->delete($path));
        collect($waterPoint->interpretation_photos ?? [])->each(fn ($path) => Storage::disk('public')->delete($path));

        $waterPoint->delete();

        return redirect()
            ->route('admin.titik-air.index')
            ->with('success', 'Titik air berhasil dihapus.');
    }
}
