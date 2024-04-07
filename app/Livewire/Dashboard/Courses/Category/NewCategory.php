<?php

namespace App\Livewire\Dashboard\Courses\Category;


use Livewire\Component;
use App\Models\Category;
use App\Models\Country;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;

class NewCategory extends Component
{
    use WithFileUploads, ImageProcessing;

    protected $listeners = ['edit' => 'edit'];
    public $country_id,$name,$image,$imagold,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {

            $this->image = null;
            $CC = Category::find($id);
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
            $CC = Category::find($this->id);
            $CC->name = $this->name;
            $CC->country_id = $this->country_id;
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false,  null,null,'category',264,280);
                $CC->image =  $dataX['image'];
            }
            $CC->save();
        }else{
            $CC = Category::create(['name' => $this->name,'country_id'=>$this->country_id]);
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false, null,null,'category',264,280);
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
        $country = Country::get();
        return view('dashboard.courses.category.new-category',compact('country'));
    }
}
