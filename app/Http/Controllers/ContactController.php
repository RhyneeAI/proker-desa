<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        $contact = Contact::firstOrFail();

        return view('public.contact.show', compact('contact'));
    }
}
