<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Stages;
use App\Models\Courses;
use App\Models\Lessons;
use Livewire\Component;
use App\Models\CourseStages;
use App\Models\CourseTrainers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ViewCourses extends Component
{


    public function dup($id)
    {
        DB::beginTransaction();
        try {
            $Courses = Courses::with('stages.lessons')->find($id);
            $newCourses = $Courses->replicate();
            $newCourses->description = $Courses->description;
            $newCourses->created_at = Carbon::now();
            $newCourses->save();
            foreach ($Courses->stages as $stages) {
                foreach ($stages->lessons as $lesson) {
                       $lessonold =  $lesson;
                }
                $newlesson =      $lessonold->replicate();
                $newlesson->created_at = Carbon::now();
                $newlesson->save();
                $newCourses->stages()->attach($stages->id, ['course_id' =>  $newCourses->id, 'lesson_id' => $newlesson->id,  'publish_at' => Carbon::now(), 'created_at' => Carbon::now()]);
            }
            DB::commit();
            $this->dispatch('swal', message: 'تم نسخ الدورة بنجاح');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            // return false;
        }
    }
    public function render()
    {
        $courses = Courses::get();
        return view('dashboard.courses.view-courses', compact('courses'));
    }
}
