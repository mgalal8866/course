<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Test extends Component
{
    public $t1 ,$t2;
    public function tt()
    {
     dd($this->t1 ,$this->t2);
    }
    public function render()
    {
        return view('dashboard.test');
    }
}
