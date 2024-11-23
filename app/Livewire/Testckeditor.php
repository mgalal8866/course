<?php

namespace App\Livewire;

use Livewire\Component;

class Testckeditor extends Component
{
    public $ck ,$ck1 ;


    public function save()
    {
        dd($this->ck , $this->ck1);
    }
    public function render()
    {
        return view('testckeditor');
    }
}
