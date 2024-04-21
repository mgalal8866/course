<?php

namespace App\Livewire\Dashboard\ContactUs;

use App\Models\ContentUs;
use Livewire\Component;

class ViewContact extends Component
{
    public function render()
    {
        $contents = ContentUs::get();
        return view('dashboard.contact-us.view-contact',compact('contents'));
    }
}
