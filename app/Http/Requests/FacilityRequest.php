<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacilityRequest extends FormRequest
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
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-11,6'],
            'longitude' => ['nullable', 'numeric', 'between:95,141'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama fasilitas wajib diisi.',
            'latitude.between' => 'Latitude harus dalam wilayah Indonesia.',
            'longitude.between' => 'Longitude harus dalam wilayah Indonesia.',
        ];
    }
}
