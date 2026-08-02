<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:2048'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'in:kegiatan,fasilitas,umkm,lainnya'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Foto wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran foto maksimal 2MB.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in' => 'Kategori tidak valid.',
        ];
    }
}
