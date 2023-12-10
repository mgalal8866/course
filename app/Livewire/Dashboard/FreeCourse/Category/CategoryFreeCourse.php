<?php

namespace App\Livewire\Dashboard\FreeCourse\Category;

use App\Models\CategoryFCourse;
use Livewire\Component;

class CategoryFreeCourse extends Component
{
    protected $listeners = ['r'=>'$refresh'];

    public function activetoggle($id)
    {
        $CFC = CategoryFCourse::find($id);
        if($CFC->active == 1){
            $CFC->update(['active' => 0 ]);
        }
        else{
            $CFC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CFC = CategoryFCourse::find($id);
        $CFC->delete();

    }
    public function render()
    {
        $CfCourse = CategoryFCourse::latest()->get();
         return view('dashboard.free-course.category.category-free-course',compact('CfCourse'));
    }
}
