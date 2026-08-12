<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UmkmRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-11,6'],
            'longitude' => ['nullable', 'numeric', 'between:95,141'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
            'documentation_photos' => ['nullable', 'array'],
            'documentation_photos.*' => ['image', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama usaha wajib diisi.',
            'latitude.between' => 'Latitude harus dalam wilayah Indonesia.',
            'longitude.between' => 'Longitude harus dalam wilayah Indonesia.',
        ];
    }
}
