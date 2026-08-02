<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWisataRequest;
use App\Http\Requests\UpdateWisataRequest;
use App\Models\Wisata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WisataController extends Controller
{
    public function index(): View
    {
        $wisatas = Wisata::latest()->paginate(10);

        return view('admin.wisatas.index', compact('wisatas'));
    }

    public function create(): View
    {
        return view('admin.wisatas.create');
    }

    public function store(StoreWisataRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('wisatas', 'public');
        }

        Wisata::create($validated);

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil ditambahkan.');
    }

    public function edit(Wisata $wisata): View
    {
        return view('admin.wisatas.edit', compact('wisata'));
    }

    public function update(UpdateWisataRequest $request, Wisata $wisata): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($wisata->photo) {
                Storage::disk('public')->delete($wisata->photo);
            }
            $validated['photo'] = $request->file('photo')->store('wisatas', 'public');
        }

        $wisata->update($validated);

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil diperbarui.');
    }

    public function destroy(Wisata $wisata): RedirectResponse
    {
        if ($wisata->photo) {
            Storage::disk('public')->delete($wisata->photo);
        }

        $wisata->delete();

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil dihapus.');
    }
}
