<?php

namespace App\Livewire\Dashboard\Courses\Category;


use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;

class NewCategory extends Component
{
    use WithFileUploads, ImageProcessing;

    protected $listeners = ['edit' => 'edit'];
    public $name,$image,$imagold,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {

            $this->image = null;
            $CC = Category::find($id);
            $this->name = $CC->name;
            $this->id = $id;
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
            $CC = Category::find($this->id);
            $CC->name = $this->name;
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false,  $CC->id,'category');
                $CC->image =  $dataX['image'];
            }
            $CC->save();
        }else{
            $CC = Category::create(['name' => $this->name]);
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false,  $CC->id,'category');
                $CC->image =  $dataX['image'];
            }
            $CC->save();
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('category_course_refresh');
        $this->reset('name');

    }
    public function render()
    {
        return view('dashboard.courses.category.new-category');
    }
}
