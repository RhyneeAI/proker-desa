<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVillageProfileRequest;
use App\Models\VillageProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VillageProfileController extends Controller
{
    public function edit(): View
    {
        $profile = VillageProfile::firstOrFail();

        return view('admin.village-profile.edit', compact('profile'));
    }

    public function update(UpdateVillageProfileRequest $request): RedirectResponse
    {
        $profile = VillageProfile::firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $validated['logo'] = $request->file('logo')->store('village-profile', 'public');
        }

        if ($request->hasFile('cover_image')) {
            if ($profile->cover_image) {
                Storage::disk('public')->delete($profile->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('village-profile', 'public');
        }

        if ($request->hasFile('org_chart_image')) {
            if ($profile->org_chart_image) {
                Storage::disk('public')->delete($profile->org_chart_image);
            }
            $validated['org_chart_image'] = $request->file('org_chart_image')->store('village-profile', 'public');
        }

        if ($request->hasFile('bpd_chart_image')) {
            if ($profile->bpd_chart_image) {
                Storage::disk('public')->delete($profile->bpd_chart_image);
            }
            $validated['bpd_chart_image'] = $request->file('bpd_chart_image')->store('village-profile', 'public');
        }

        $profile->update($validated);

        return redirect()
            ->route('admin.profil-desa.edit')
            ->with('success', 'Profil desa berhasil diperbarui.');
    }
}
