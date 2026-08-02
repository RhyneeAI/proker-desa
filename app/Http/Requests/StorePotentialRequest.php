<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePotentialRequest extends FormRequest
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
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama potensi wajib diisi.',
            'name.max' => 'Nama potensi maksimal 255 karakter.',
            'category.max' => 'Kategori maksimal 100 karakter.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'photo_alt.max' => 'Teks alternatif maksimal 255 karakter.',
        ];
    }
}
