<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WaterPointRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'start_latitude' => ['nullable', 'numeric', 'between:-11,6'],
            'start_longitude' => ['nullable', 'numeric', 'between:95,141'],
            'end_latitude' => ['nullable', 'numeric', 'between:-11,6'],
            'end_longitude' => ['nullable', 'numeric', 'between:95,141'],
            'recommend_latitude' => ['nullable', 'numeric', 'between:-11,6'],
            'recommend_longitude' => ['nullable', 'numeric', 'between:95,141'],
            'direction' => ['nullable', 'string', 'max:100'],
            'debit' => ['nullable', 'string', 'max:50'],
            'documentation_photos' => ['nullable', 'array'],
            'documentation_photos.*' => ['image', 'max:5120'],
            'interpretation_photos' => ['nullable', 'array'],
            'interpretation_photos.*' => ['image'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama titik air wajib diisi.',
            'start_latitude.between' => 'Latitude titik awal harus dalam wilayah Indonesia.',
            'start_longitude.between' => 'Longitude titik awal harus dalam wilayah Indonesia.',
            'end_latitude.between' => 'Latitude titik akhir harus dalam wilayah Indonesia.',
            'end_longitude.between' => 'Longitude titik akhir harus dalam wilayah Indonesia.',
            'recommend_latitude.between' => 'Latitude titik rekomendasi harus dalam wilayah Indonesia.',
            'recommend_longitude.between' => 'Longitude titik rekomendasi harus dalam wilayah Indonesia.',
        ];
    }
}
