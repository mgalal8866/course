<?php

namespace App\Livewire\Dashboard\FreeCourse\Category;

use App\Models\Country;
use Livewire\Component;
use App\Models\CategoryFCourse;

class NewCategory extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $country_id,$name,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {
            $CFC = CategoryFCourse::find($id);
            $this->name = $CFC->name;
            $this->id = $id;
            $this->country_id = $CFC->country_id;
            $this->edit = true;
            $this->header = __('tran.editcategory');
        }else{
          $this->name =null;
          $this->edit = false;
          $this->country_id = null;
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
            $CFC = CategoryFCourse::find($this->id);
            $CFC->update(['name' => $this->name,'country_id'=>$this->country_id]);
        }else{
            CategoryFCourse::create(['name' => $this->name,'country_id'=>$this->country_id]);
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('r');
        $this->reset('name');

    }
    public function render()
    {
        $country = Country::get();
        return view('dashboard.free-course.category.new-category',compact('country'));
    }
}
