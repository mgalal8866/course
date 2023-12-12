<?php

namespace App\Livewire\Dashboard\Courses\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryCourse extends Component
{
    protected $listeners = ['category_course_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = Category::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = Category::find($id);
        $CC->delete();

    }
    public function render()
    {
        $CCourse = Category::latest()->get();
         return view('dashboard.courses.category.category-course',compact('CCourse'));
    }
}
