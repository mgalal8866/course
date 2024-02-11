<?php

namespace App\Livewire\Dashboard\Grades;

use Livewire\Component;
use App\Models\UsersGrades;

class ViewGrades extends Component
{
    protected $listeners = ['grades_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = UsersGrades::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = UsersGrades::find($id);
        $CC->delete();

    }
    public function render()
    {
        $grades = UsersGrades::latest()->get();
        return view('dashboard.grades.view-grades',compact('grades'));
    }
}
