<?php

namespace App\Livewire\Dashboard\Exams\Category;


use App\Models\CategoryExams;
use Livewire\Component;

class NewCategory extends Component
{
    protected $listeners = ['edit' => 'edit'];
    public $name,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {
            $CC = CategoryExams::find($id);
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
            $CC = CategoryExams::find($this->id);
            $CC->update(['name' => $this->name]);
        }else{
            CategoryExams::create(['name' => $this->name]);
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('category_exams_refresh');
        $this->reset('name');

    }
    public function render()
    {
        return view('dashboard.exams.category.new-category');
    }
}
