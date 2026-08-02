<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePotensiDesaRequest;
use App\Http\Requests\UpdatePotensiDesaRequest;
use App\Models\PotensiDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PotensiDesaController extends Controller
{
    public function index(): View
    {
        $potensiDesa = PotensiDesa::orderBy('display_order')
            ->orderBy('id')
            ->get();

        return view('admin.potensi-desa.index', compact('potensiDesa'));
    }

    public function create(): View
    {
        return view('admin.potensi-desa.create');
    }

    public function store(StorePotensiDesaRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('potensi', 'public');
        }

        PotensiDesa::create($validated);

        return redirect()
            ->route('admin.potensi-desa.index')
            ->with('success', 'Potensi desa berhasil ditambahkan.');
    }

    public function edit(PotensiDesa $potensiDesa): View
    {
        return view('admin.potensi-desa.edit', ['potensiDesa' => $potensiDesa]);
    }

    public function update(UpdatePotensiDesaRequest $request, PotensiDesa $potensiDesa): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($potensiDesa->image) {
                Storage::disk('public')->delete($potensiDesa->image);
            }
            $validated['image'] = $request->file('image')->store('potensi', 'public');
        }

        $potensiDesa->update($validated);

        return redirect()
            ->route('admin.potensi-desa.index')
            ->with('success', 'Potensi desa berhasil diperbarui.');
    }

    public function destroy(PotensiDesa $potensiDesa): RedirectResponse
    {
        if ($potensiDesa->image) {
            Storage::disk('public')->delete($potensiDesa->image);
        }

        $potensiDesa->delete();

        return redirect()
            ->route('admin.potensi-desa.index')
            ->with('success', 'Potensi desa berhasil dihapus.');
    }
}
