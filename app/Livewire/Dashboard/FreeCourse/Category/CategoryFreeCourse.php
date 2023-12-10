<?php

namespace App\Livewire\Dashboard\FreeCourse\Category;

use App\Models\CategoryFCourse;
use Livewire\Component;

class CategoryFreeCourse extends Component
{
    public function ooo()
    {
        // dd('ss');
        // $this->dispatch('openmodel','new-category');
        $this->dispatch('openChildComponent');
    }
    public function render()
    {
        $CfCourse = CategoryFCourse::get();
         return view('dashboard.free-course.category.category-free-course',compact('CfCourse'));
    }
}
