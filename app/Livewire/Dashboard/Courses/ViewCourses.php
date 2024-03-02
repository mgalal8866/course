<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Courses;
use App\Models\CourseStages;
use App\Models\CourseTrainers;
use App\Models\Lessons;
use App\Models\Stages;
use Livewire\Component;
use Illuminate\Support\Carbon;

class ViewCourses extends Component
{


    public function dup($id)
    {
        $Courses = Courses::with('stages.lessons')->find($id);
        $newCourses = $Courses->replicate();
        $newCourses->description = $Courses->description;
        $newCourses->created_at = Carbon::now();
        $newCourses->save();
        foreach ($Courses->stages as $stages) {
            foreach ($stages->lessons as $lesson) {

               $lessonold =  $lesson;
            }
            $newCourses->stages()->attach($stages->id, ['course_id' =>  $newCourses->id, 'lesson_id' => $lessonold->id,   'created_at' => Carbon::now()]);
        }
        $this->dispatch('swal', message: 'تم نسخ الدورة بنجاح');

    }
    public function render()
    {
        $courses = Courses::get();
        return view('dashboard.courses.view-courses', compact('courses'));
    }
}
