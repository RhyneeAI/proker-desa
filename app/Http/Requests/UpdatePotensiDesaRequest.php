<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePotensiDesaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:pertanian,wisata,alam,ekonomi,budaya,lainnya'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama potensi wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in' => 'Kategori tidak valid.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
