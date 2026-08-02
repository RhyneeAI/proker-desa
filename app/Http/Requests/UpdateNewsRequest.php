<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'thumbnail_alt' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul berita wajib diisi.',
            'content.required' => 'Isi berita wajib diisi.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
        ];
    }
}
