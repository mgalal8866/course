<?php

namespace App\Livewire\Dashboard\Grades\Category;

use App\Models\CategoryGrades as ModelsCategoryGrades;
use Livewire\Component;

class CategoryGrades extends Component
{
    protected $listeners = ['category_grades_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = ModelsCategoryGrades::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = ModelsCategoryGrades::find($id);
        $CC->delete();

    }
    public function render()
    {
        $Category = ModelsCategoryGrades::latest()->get();
        return view('dashboard.grades.category.category-grades',compact('Category'));
    }
}
