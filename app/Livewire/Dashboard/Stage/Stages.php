<?php

namespace App\Livewire\Dashboard\Stage;

use App\Models\Stages as ModelsStages;
use Livewire\Component;

class Stages extends Component
{

    protected $listeners = ['stages_refresh'=>'$refresh'];

    public function activetoggle($id)
     {
         $CC = ModelsStages::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = ModelsStages::find($id);
        $CC->delete();

    }
    public function render()
    {
        $stages = ModelsStages::latest()->get();
        return view('dashboard.stage.stages',compact('stages'));
    }
}
