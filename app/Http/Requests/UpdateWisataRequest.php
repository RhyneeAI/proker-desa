<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWisataRequest extends FormRequest
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
            'address' => ['nullable', 'string'],
            'opening_hours' => ['nullable', 'string', 'max:100'],
            'ticket_price' => ['nullable', 'string', 'max:100'],
            'latitude' => ['nullable', 'numeric', 'between:-11,6'],
            'longitude' => ['nullable', 'numeric', 'between:95,141'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wisata wajib diisi.',
            'latitude.between' => 'Latitude harus dalam wilayah Indonesia.',
            'longitude.between' => 'Longitude harus dalam wilayah Indonesia.',
        ];
    }
}
