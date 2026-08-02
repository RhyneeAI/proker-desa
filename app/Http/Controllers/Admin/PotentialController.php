<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PotentialRequest;
use App\Models\Potential;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PotentialController extends Controller
{
    public function index(): View
    {
        $potentials = Potential::latest()->get();

        return view('admin.potentials.index', compact('potentials'));
    }

    public function create(): View
    {
        return view('admin.potentials.create');
    }

    public function store(PotentialRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('potentials', 'public');
        }

        Potential::create($validated);

        return redirect()
            ->route('admin.potensi.index')
            ->with('success', 'Potensi desa berhasil ditambahkan.');
    }

    public function edit(Potential $potential): View
    {
        return view('admin.potentials.edit', compact('potential'));
    }

    public function update(PotentialRequest $request, Potential $potential): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($potential->photo) {
                Storage::disk('public')->delete($potential->photo);
            }
            $validated['photo'] = $request->file('photo')->store('potentials', 'public');
        }

        $potential->update($validated);

        return redirect()
            ->route('admin.potensi.index')
            ->with('success', 'Potensi desa berhasil diperbarui.');
    }

    public function destroy(Potential $potential): RedirectResponse
    {
        if ($potential->photo) {
            Storage::disk('public')->delete($potential->photo);
        }

        $potential->delete();

        return redirect()
            ->route('admin.potensi.index')
            ->with('success', 'Potensi desa berhasil dihapus.');
    }
}
