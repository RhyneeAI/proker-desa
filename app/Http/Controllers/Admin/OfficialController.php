<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficialRequest;
use App\Models\Official;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OfficialController extends Controller
{
    public function index(): View
    {
        $officials = Official::orderBy('display_order')
            ->orderBy('id')
            ->get();

        return view('admin.officials.index', compact('officials'));
    }

    public function create(): View
    {
        return view('admin.officials.create');
    }

    public function store(OfficialRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('officials', 'public');
        }

        Official::create($validated);

        return redirect()
            ->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil ditambahkan.');
    }

    public function edit(Official $aparatur): View
    {
        return view('admin.officials.edit', ['official' => $aparatur]);
    }

    public function update(OfficialRequest $request, Official $aparatur): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($aparatur->photo) {
                Storage::disk('public')->delete($aparatur->photo);
            }
            $validated['photo'] = $request->file('photo')->store('officials', 'public');
        }

        $aparatur->update($validated);

        return redirect()
            ->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil diperbarui.');
    }

    public function destroy(Official $aparatur): RedirectResponse
    {
        if ($aparatur->photo) {
            Storage::disk('public')->delete($aparatur->photo);
        }

        $aparatur->delete();

        return redirect()
            ->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil dihapus.');
    }
}
