<?php

namespace App\Livewire\Dashboard\Stage;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Stages as ModelsStages;

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
        DB::beginTransaction();
        try{
            ModelsStages::findOrFail($id)->delete();

            // $CC = ModelsStages::find($id);
            // $CC->delete();
            DB::commit();
            $this->dispatch('swal', type:'success',message: 'تم الحذف');

        }catch(Exception $e){
            DB::rollBack();
            if ($e->getCode() == 23000) {
                $this->dispatch('swal', type:'danger',message: 'Cannot delete this stage because it is associated with other records.');

            }
            $this->dispatch('swal', type:'danger',message: 'Something went wrong. Please try again.');
        }


    }
    public function render()
    {
        $stages = ModelsStages::latest()->get();
        return view('dashboard.stage.stages',compact('stages'));
    }
}
