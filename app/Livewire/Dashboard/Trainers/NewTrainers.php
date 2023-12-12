<?php

namespace App\Livewire\Dashboard\Trainers;



use App\Models\Trainer;
use Livewire\Component;

class NewTrainers extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $name,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {
            $CC = Trainer::find($id);
            $this->name = $CC->name;
            $this->id = $id;
            $this->edit = true;
            $this->header = __('tran.add') .' '. __('tran.trainer');
        }else{
          $this->name =null;
          $this->edit = false;
          $this->header =  __('tran.add') .' '.__('tran.trainer');
        }
        $this->dispatch('openmodel');
    }
    protected $rules = [
        'name' => 'required',

    ];

    public function save()
    {
        $this->validate();
        if( $this->edit == true){
            $CC = Trainer::find($this->id);
            $CC->update(['name' => $this->name]);
        }else{
            Trainer::create(['name' => $this->name]);
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('trainer_course_refresh');
        $this->reset('name');

    }
    public function render()
    {
        return view('dashboard.trainers.new-trainers');
    }
}
