<?php

namespace App\Livewire\Dashboard\Trainers;


use App\Models\Category;
use Livewire\Component;

class NewTrainers extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $name,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {
            $CC = Category::find($id);
            $this->name = $CC->name;
            $this->id = $id;
            $this->edit = true;
            $this->header = __('tran.editcategory');
        }else{
          $this->name =null;
          $this->edit = false;
          $this->header = __('tran.newcategory');
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
            $CC = Category::find($this->id);
            $CC->update(['name' => $this->name]);
        }else{
            Category::create(['name' => $this->name]);
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('category_course_refresh');
        $this->reset('name');

    }
    public function render()
    {
        return view('dashboard.trainers.new-trainers');
    }
}
