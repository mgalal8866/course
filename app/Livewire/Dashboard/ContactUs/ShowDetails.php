<?php

namespace App\Livewire\Dashboard\ContactUs;

use Livewire\Component;
use App\Models\ContentUs;
class ShowDetails extends Component
{
    protected $listeners = ['showdetails' => 'showdetails'];
    public $contents1 =[],$id;
    public function showdetails($id = null)
    {
        $this->id = $id;
        $this->contents1 = ContentUs::find($this->id);
        $this->dispatch('openmodel');
    }
    public function render()
    {
        return view('dashboard.contact-us.show-details');
    }
}
