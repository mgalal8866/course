<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Courses;
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

        $recordsToDuplicate = Record::whereIn('id', [1, 2, 3])->get();

// Step 2: Create new instances of the model with copied data
$duplicatedRecords = [];
foreach ($recordsToDuplicate as $record) {
    $newRecord = $record->replicate(); // This creates a new instance with the same attributes
    // Optionally, modify any attributes of the new record here
    $newRecord->save();
    $duplicatedRecords[] = $newRecord;
}

    }
    public function render()
    {
        $courses = Courses::get();
        return view('dashboard.courses.view-courses',compact('courses'));
    }
}
