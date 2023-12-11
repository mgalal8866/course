<?php

namespace App\Livewire\Dashboard\FreeCourse\Category;

use App\Models\CategoryFCourse;
use Livewire\Component;

class NewCategory extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $name,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {
            $CFC = CategoryFCourse::find($id);
            $this->name = $CFC->name;
            $this->id = $id;
            $this->edit = true;
            $this->header = __('tran.editcategory');
        }else{
          $this->name =null;
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
        if( $this->edit = true){
            $CFC = CategoryFCourse::find($this->id);
            $CFC->update(['name' => $this->name]);
        }else{
            CategoryFCourse::create(['name' => $this->name]);
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('r');
        $this->reset('name');

    }
    public function render()
    {
        return view('dashboard.free-course.category.new-category');
    }
}
