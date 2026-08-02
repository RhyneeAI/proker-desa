<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVillageProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'village_name' => ['required', 'string', 'max:255'],
            'history' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'area_size' => ['nullable', 'numeric', 'min:0'],
            'population' => ['nullable', 'integer', 'min:0'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'logo_alt' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'cover_image_alt' => ['nullable', 'string', 'max:255'],
            'map_embed' => ['nullable', 'string'],
            'border_north' => ['nullable', 'string', 'max:255'],
            'border_south' => ['nullable', 'string', 'max:255'],
            'border_east' => ['nullable', 'string', 'max:255'],
            'border_west' => ['nullable', 'string', 'max:255'],
            'org_chart_image' => ['nullable', 'image', 'max:4096'],
            'bpd_chart_image' => ['nullable', 'image', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'village_name.required' => 'Nama desa wajib diisi.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.max' => 'Ukuran logo maksimal 2MB.',
            'cover_image.image' => 'File cover harus berupa gambar.',
            'cover_image.max' => 'Ukuran cover maksimal 4MB.',
            'org_chart_image.image' => 'File bagan organisasi harus berupa gambar.',
            'org_chart_image.max' => 'Ukuran bagan organisasi maksimal 4MB.',
            'bpd_chart_image.image' => 'File bagan BPD harus berupa gambar.',
            'bpd_chart_image.max' => 'Ukuran bagan BPD maksimal 4MB.',
        ];
    }
}
