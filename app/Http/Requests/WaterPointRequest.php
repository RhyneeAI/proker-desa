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
            'category' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-11,6'],
            'longitude' => ['nullable', 'numeric', 'between:95,141'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama titik air wajib diisi.',
            'latitude.between' => 'Latitude harus dalam wilayah Indonesia.',
            'longitude.between' => 'Longitude harus dalam wilayah Indonesia.',
        ];
    }
}
