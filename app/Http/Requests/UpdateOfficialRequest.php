<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
            'display_order' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'position.required' => 'Jabatan wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'display_order.required' => 'Urutan tampil wajib diisi.',
            'display_order.integer' => 'Urutan tampil harus berupa angka.',
        ];
    }
}
