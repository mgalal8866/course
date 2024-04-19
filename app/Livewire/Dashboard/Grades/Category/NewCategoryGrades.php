<?php

namespace App\Livewire\Dashboard\Grades\Category;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CategoryGrades;

class NewCategoryGrades extends Component
{
    use WithFileUploads;

    protected $listeners = ['edit' => 'edit'];
    public $country_id,$name,$image,$imagold,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {

            $this->image = null;
            $CC = CategoryGrades::find($id);
            $this->name = $CC->name;
            $this->id = $id;
            $this->country_id = $CC->country_id;
            $this->imagold = $CC->image !=null? $CC->imageurl:null;
            $this->edit = true;
            $this->header = __('tran.editcategory');
        }else{
          $this->name =null;
          $this->imagold =null;
          $this->image =null;
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
            $CC = CategoryGrades::find($this->id);
            $CC->name = $this->name;
            $CC->country_id = $this->country_id;

            $CC->save();
        }else{
            $CC = CategoryGrades::create(['name' => $this->name,'country_id'=>$this->country_id]);

            $CC->save();
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('category_grades_refresh');
        $this->reset('name');

    }
    public function render()
    {
        $country = Country::get();
        return view('dashboard.grades.category.new-category-grades',compact('country'));
    }
}
