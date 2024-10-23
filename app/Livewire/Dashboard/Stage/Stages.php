<?php

namespace App\Livewire\Dashboard\Stage;

use App\Models\Stages as ModelsStages;
use Exception;
use Livewire\Component;

class Stages extends Component
{

    protected $listeners = ['stages_refresh'=>'$refresh'];
public $maincat;
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
        try{
            $CC = ModelsStages::find($id);
            $CC->delete();
            $this->dispatch('swal', type:'success',message: 'تم الحذف');

        }catch(Exception $e){

            $this->dispatch('swal', type:'danger',message: $e->getMessage());
        }


    }
    public function render()
    {
        $stages = ModelsStages::latest()->get();
        return view('dashboard.stage.stages',compact('stages'));
    }
}
