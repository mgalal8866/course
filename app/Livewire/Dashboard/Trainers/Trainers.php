<?php

namespace App\Livewire\Dashboard\Trainers;

use App\Models\User;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Specialist;

class Trainers extends Component
{
  

    protected $listeners = ['trainer_course_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = User::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = User::find($id);
        $CC->delete();

    }
    public function render()
    {

        $trainer = User::whereType(1)->latest()->get();
         return view('dashboard.trainers.trainers',compact('trainer'));
    }
}
