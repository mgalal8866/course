<?php

namespace App\Livewire\Dashboard\Trainers\Payments;

use Livewire\Component;
 

class ViewPaymentsMethod extends Component
{
    protected $listeners = ['specialist_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = ModalSpecialist::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = ModalSpecialist::find($id);
        $CC->delete();

    }
    public function render()
    {

        $specialist = ModalSpecialist::withCount('trainer')->latest()->get();
         return view('dashboard.trainers.specialist.specialist',compact('specialist'));
    }
}
