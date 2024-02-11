<?php

namespace App\Livewire\Dashboard\Grades;

use Livewire\Component;
use App\Models\UsersGrades;
use Livewire\WithFileUploads;
use App\Models\CategoryGrades;
use App\Traits\ImageProcessing;
use App\Livewire\Dashboard\Courses\Category\CategoryCourse;

class NewGrades extends Component
{

    use WithFileUploads, ImageProcessing;

    protected $listeners = ['edit' => 'edit'];
    public $link,$image,$imagold,$edit=false,$id,$header,$category_id;
    public function mount(){

    }
    public function edit($id = null)
    {
        if ($id != null) {

            $this->image = null;
            $CC = UsersGrades::find($id);
            $this->link = $CC->link;
            $this->id = $id;
            $this->category_id =  $CC->category_id;
            $this->imagold = $CC->image !=null? $CC->imageurl:null;
            $this->edit = true;
            $this->header = __('tran.editcategory');
        }else{
            $this->reset();
        //   $this->link =null;
        //   $this->imagold =null;
        //   $this->image =null;
        //   $this->edit = false;
          $this->header = __('tran.newstudentgrades');
        }
        $this->dispatch('openmodel');
    }
    protected $rules = [
        'link' => 'required',

    ];

    public function save()
    {

        $this->validate();
        if( $this->edit == true){
            $CC = UsersGrades::find($this->id);
            $CC->link = $this->link;
            $CC->category_id = $this->category_id;


        }else{
            $CC = UsersGrades::create(['link' => $this->link,'category_id'=>$this->category_id]);

        }
        if ($this->image) {
            $dataX = $this->saveImageAndThumbnail($this->image, false,  null,null,'grades');
            $CC->image =  $dataX['image'];
        }
        $CC->save();
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('grades_refresh');
        $this->reset('link');

    }
    public function render()
    {
        $categorys = CategoryGrades::latest()->get();
        return view('dashboard.grades.new-grades',compact('categorys'));
    }
}
