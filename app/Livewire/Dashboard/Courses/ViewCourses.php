<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Courses;
use App\Models\Lessons;
use Livewire\Component;
use Illuminate\Support\Carbon;

class ViewCourses extends Component
{


    public function dup()
    {
        $Courses = Courses::find(1);
        $newCourses = $Courses->replicate();
        $newCourses->created_at = Carbon::now();
        $newCourses->save();

        $recordsToDuplicate = Lessons::whereIn('id', [1, 2, 3])->get();

        // Step 2: Create new instances of the model with copied data
        $duplicatedRecords = [];
        foreach ($recordsToDuplicate as $record) {
            $newRecord = $record->replicate(); // This creates a new instance with the same attributes
            // Optionally, modify any attributes of the new record here
            $newRecord->save();
            $duplicatedRecords[] = $newRecord;
        }

        // foreach ($this->triner as $i) {
        //     $CFC->coursetrainers()->create(['trainer_id' => $i]);
        // }
        // foreach ($this->lessons as $i) {
        //     $lesson = $CFC->lessons()->create(['name' => $i['name'], 'link_video' => $i['link'], 'is_lesson' => $i['is_lesson'] != true ? 0 : 1, 'publish_at' => $i['publish_at']]);
        //     $CFC->stages()->attach($i['stage_id'], ['course_id' => $CFC->id, 'lesson_id' => $lesson->id]);
        // }
    }
    public function render()
    {
        $courses = Courses::get();
        return view('dashboard.courses.view-courses', compact('courses'));
    }
}
