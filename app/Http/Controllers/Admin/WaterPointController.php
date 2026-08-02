<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WaterPointRequest;
use App\Models\WaterPoint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WaterPointController extends Controller
{
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

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('water-points', 'public');
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

        if ($request->hasFile('photo')) {
            if ($waterPoint->photo) {
                Storage::disk('public')->delete($waterPoint->photo);
            }
            $validated['photo'] = $request->file('photo')->store('water-points', 'public');
        }

        $waterPoint->update($validated);

        return redirect()
            ->route('admin.titik-air.index')
            ->with('success', 'Titik air berhasil diperbarui.');
    }

    public function destroy(WaterPoint $waterPoint): RedirectResponse
    {
        if ($waterPoint->photo) {
            Storage::disk('public')->delete($waterPoint->photo);
        }

        $waterPoint->delete();

        return redirect()
            ->route('admin.titik-air.index')
            ->with('success', 'Titik air berhasil dihapus.');
    }
}
