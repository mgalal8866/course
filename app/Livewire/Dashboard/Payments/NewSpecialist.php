<?php

namespace App\Livewire\Dashboard\Trainers\Specialist;

use Livewire\Component;
use App\Models\Specialist;

class NewSpecialist extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public  $active, $name, $edit = false, $id, $header;
    protected $rules = [
        'name'       => 'required',

    ];

    public function edit($id = null)
    {
        $this->edit = false;
        if ($id != null) {
            $tra = Specialist::find($id);
            $this->id = $tra->id;
            $this->name = $tra->name;
            $this->active = $tra->active==1?true:false;
            $this->edit = true;
            $this->header = __('tran.edit') . ' ' . __('tran.specialist');
        } else {
            $this->name = null;
            $this->edit = false;
            $this->header =  __('tran.add') . ' ' . __('tran.specialist');
        }
        $this->dispatch('openmodel');
    }

    public function save()
    {
        $this->validate();
        $CFC = Specialist::updateOrCreate(['id' => $this->id], [
            'name'       => $this->name,
            'active' => $this->active??1
        ]);
        $this->dispatch('closemodel');
        $this->dispatch('specialist_refresh');

    }
    public function render()
    {
        $spec  = Specialist::latest()->get();
        return view('dashboard.trainers.specialist.new-specialist', compact('spec'));
    }
}
