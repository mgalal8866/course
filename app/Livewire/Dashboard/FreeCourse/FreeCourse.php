<?php

namespace App\Livewire\Dashboard\FreeCourse;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FreeCourse as ModelsFreeCourse;

class FreeCourse extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
       $freecourse =  ModelsFreeCourse::latest()->paginate(20);
        return view('dashboard.free-course.free-course', compact('freecourse'));
    }
}
