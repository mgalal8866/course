<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Courses;
use Livewire\Component;

class ViewCourses extends Component
{
    public function render()
    {
        $courses = Courses::get();
        return view('dashboard.courses.view-courses',compact('courses'));
    }
}
