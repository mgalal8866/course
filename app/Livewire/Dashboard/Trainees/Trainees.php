<?php

namespace App\Livewire\Dashboard\Trainees;

use App\Models\User;
use Livewire\Component;

class Trainees extends Component
{
    protected $listeners = ['trainees_course_refresh'=>'$refresh'];

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

        $trainees = User::latest()->get();
         return view('dashboard.trainees.trainees',compact('trainees'));
    }
}
