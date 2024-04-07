<?php

namespace App\Livewire\Dashboard\Quizzes\QuizCategory;


use App\Models\Country;
use Livewire\Component;
use App\Models\CategoryExams;

class NewQuizCategory extends Component
{
    protected $listeners = ['edit' => 'edit'];
    public $country_id,$name,$edit=false,$id,$header,$typecategory;
    public function edit($id = null)
    {
        if ($id != null) {
            $CC = CategoryExams::find($id);
            $this->name = $CC->name;
            $this->typecategory = $CC->typecategory;
            $this->id = $id;
            $this->country_id = $CC->country_id;
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
            $CC->update(['name' => $this->name,'typecategory'=>$this->typecategory,'country_id'=>$this->country_id]);
        }else{
            CategoryExams::create(['name' => $this->name,'typecategory'=>$this->typecategory,'country_id'=>$this->country_id]);
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('category_exams_refresh');
        $this->reset('name');

    }
    public function render()
    {
        $country = Country::get();
        return view('dashboard.quizzes.category-quiz.new-category',compact('country'));
    }
}
