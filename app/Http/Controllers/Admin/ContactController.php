<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function edit(): View
    {
        $contact = Contact::firstOrFail();

        return view('admin.contact.edit', compact('contact'));
    }

    public function update(ContactRequest $request): RedirectResponse
    {
        $contact = Contact::firstOrFail();
        $contact->update($request->validated());

        return redirect()
            ->route('admin.kontak.edit')
            ->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
