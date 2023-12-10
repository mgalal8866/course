<?php

namespace App\Livewire\Dashboard\FreeCourse;

use App\Models\CategoryFCourse;
use Livewire\Component;

class CategoryFreeCourse extends Component
{
    public function render()
    {
        $CfCourse = CategoryFCourse::get();
         return view('dashboard.free-course.category-free-course',compact('CfCourse'));
    }
}
