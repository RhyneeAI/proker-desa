<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        $facilities = Facility::latest()->paginate(10);

        return view('admin.facilities.index', compact('facilities'));
    }

    public function create(): View
    {
        return view('admin.facilities.create');
    }

    public function store(StoreFacilityRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('facilities', 'public');
        }

        Facility::create($validated);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $fasilita): View
    {
        return view('admin.facilities.edit', ['facility' => $fasilita]);
    }

    public function update(UpdateFacilityRequest $request, Facility $fasilita): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($fasilita->photo) {
                Storage::disk('public')->delete($fasilita->photo);
            }
            $validated['photo'] = $request->file('photo')->store('facilities', 'public');
        }

        $fasilita->update($validated);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $fasilita): RedirectResponse
    {
        if ($fasilita->photo) {
            Storage::disk('public')->delete($fasilita->photo);
        }

        $fasilita->delete();

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
