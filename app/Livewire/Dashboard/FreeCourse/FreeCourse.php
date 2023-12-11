<?php

namespace App\Livewire\Dashboard\FreeCourse;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FreeCourse as ModelsFreeCourse;

class FreeCourse extends Component
{
    use WithPagination;
    protected $listeners = ['rFreeCourse' => '$refresh'];
    protected $paginationTheme = 'bootstrap';
    public function activetoggle($id)
    {
        $FC = ModelsFreeCourse::find($id);
        if ($FC->active == 1) {
            $FC->update(['active' => 0]);
        } else {
            $FC->update(['active' => 1]);
        }
    }
    public function delete($id)
    {
        $FC = ModelsFreeCourse::find($id);
        $FC->delete();
    }
    public function render()
    {
       $freecourse =  ModelsFreeCourse::latest()->paginate(20);
        return view('dashboard.free-course.free-course', compact('freecourse'));
    }
}
