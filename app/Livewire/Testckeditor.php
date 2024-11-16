<?php

namespace App\Livewire;

use Livewire\Component;

class Testckeditor extends Component
{
    public $ck ,$summernote,$ammath ;


    public function save()
    {
        dd($this->ck ,$this->summernote,$this->ammath);
    }
    public function render()
    {
        return view('testckeditor');
    }
}
