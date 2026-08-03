<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UmkmRequest;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UmkmController extends Controller
{
    public function index(): View
    {
        $umkms = Umkm::latest()->get();

        return view('admin.umkms.index', compact('umkms'));
    }

    public function create(): View
    {
        return view('admin.umkms.create');
    }

    public function store(UmkmRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('umkms', 'public');
        }

        if ($request->hasFile('documentation_photos')) {
            $validated['documentation_photos'] = collect($request->file('documentation_photos'))
                ->map(fn ($file) => $file->store('umkms', 'public'))
                ->values()
                ->all();
        }

        Umkm::create($validated);

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function edit(Umkm $umkm): View
    {
        return view('admin.umkms.edit', compact('umkm'));
    }

    public function update(UmkmRequest $request, Umkm $umkm): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($umkm->photo) {
                Storage::disk('public')->delete($umkm->photo);
            }
            $validated['photo'] = $request->file('photo')->store('umkms', 'public');
        }

        if ($request->hasFile('documentation_photos')) {
            collect($umkm->documentation_photos ?? [])->each(fn ($path) => Storage::disk('public')->delete($path));
            $validated['documentation_photos'] = collect($request->file('documentation_photos'))
                ->map(fn ($file) => $file->store('umkms', 'public'))
                ->values()
                ->all();
        }

        $umkm->update($validated);

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm): RedirectResponse
    {
        if ($umkm->photo) {
            Storage::disk('public')->delete($umkm->photo);
        }

        collect($umkm->documentation_photos ?? [])->each(fn ($path) => Storage::disk('public')->delete($path));

        $umkm->delete();

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil dihapus.');
    }
}
