<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
            'display_order' => ['required', 'integer', 'min:1'],
            'parent_id' => ['nullable', 'integer', 'exists:officials,id'],
        ];

        if ($this->route('aparatur')) {
            $rules['parent_id'][] = 'not_in:' . $this->route('aparatur')->id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'position.required' => 'Jabatan wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'display_order.required' => 'Urutan wajib diisi.',
            'display_order.integer' => 'Urutan harus berupa angka.',
            'display_order.min' => 'Urutan minimal 1.',
            'parent_id.exists' => 'Hierarki penempatan tidak valid.',
            'parent_id.not_in' => 'Aparatur tidak bisa menjadi bawahannya sendiri.',
        ];
    }
}
