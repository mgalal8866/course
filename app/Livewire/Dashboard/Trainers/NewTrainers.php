<?php

namespace App\Livewire\Dashboard\Trainers;



use App\Models\Trainer;
use Livewire\Component;

class NewTrainers extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $phone,$mail,$balance,$country,$gender,$specialist,$name,$edit=false,$id,$header;
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
          $this->header =  __('tran.edit') .' '.__('tran.trainer');
        }
        $this->dispatch('openmodel');
    }
    protected $rules = [
        'name'       => 'required',
        'phone'      => 'required',
        'mail'       => 'required',
        'balance'    => 'required',
        'country'    => 'required',
        'gender'     => 'required',
        'specialist' => 'required',


    ];

    public function save()
    {
        $this->validate();
        $CFC = Trainer::updateOrCreate(['id' => $this->id], [
            'name'       => $this->name,
            'phone'      => $this->phone,
            'mail'       => $this->mail,
            'balance'    => $this->balance,
            'country'    => $this->country,
            'gender'     => $this->gender,
            'specialist' => $this->specialist,
        ]);
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