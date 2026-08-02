<?php

namespace App\View\Composers;

use App\Models\Contact;
use Illuminate\View\View;

class PublicSiteComposer
{
    public function compose(View $view): void
    {
        $view->with('contact', Contact::first());
    }
}
