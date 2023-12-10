<?php

namespace App\Livewire\Dashboard\FreeCourse\Category;

use App\Models\CategoryFCourse;
use Livewire\Component;

class NewCategory extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $name,$edit=false,$id;
    public function edit($id = null)
    {
        $this->dispatch('openmodel');
        if ($id != null) {
            $CFC = CategoryFCourse::find($id);
            $this->name = $CFC->name;
            $this->id = $id;
            $this->edit = true;
        }
    }
    protected $rules = [
        'name' => 'required|min:6',

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
        $this->dispatch('closemodel');
        $this->dispatch('r');
        $this->reset('name');


    }
    public function render()
    {
        return view('dashboard.free-course.category.new-category');
    }
}
