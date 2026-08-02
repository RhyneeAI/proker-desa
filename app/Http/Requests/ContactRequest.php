<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'map_embed' => ['nullable', 'string'],
            'office_hours' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'address.required' => 'Alamat wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'facebook.url' => 'Link Facebook harus berupa URL yang valid (awali dengan https://).',
            'instagram.url' => 'Link Instagram harus berupa URL yang valid (awali dengan https://).',
            'youtube.url' => 'Link YouTube harus berupa URL yang valid (awali dengan https://).',
        ];
    }
}
