<?php

namespace App\Livewire\Dashboard\StudySchedule;

use App\Models\StudySchedule;
use Livewire\Component;

class ViewStudySchedule extends Component
{
    public  $perpage = 30;
    public function activetoggle($id)
    {
        $CC = StudySchedule::find($id);
        if ($CC->active == 1) {
            $CC->update(['active' => 0]);
        } else {
            $CC->update(['active' => 1]);
        }
    }
    public function delete($id)
    {
        $CC = StudySchedule::find($id);
        $CC->delete();
    }
    public function render()
    {
        $studyschedule = StudySchedule::paginate($this->perpage);
        return view('dashboard.study-schedule.view-study-schedule', compact('studyschedule'));
    }
}
