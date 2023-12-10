<?php

namespace App\Livewire\Dashboard\FreeCourse\Category;

use Livewire\Component;

class NewCategory extends Component
{

    protected $listeners = ['openChildComponent'];

    public function openChildComponent()
    {
        dd('sss');
        $this->dispatch('openmodel');

        // $this->isOpen = true;
    }
    public function render()
    {
        return view('dashboard.free-course.category.new-category');
    }
}
