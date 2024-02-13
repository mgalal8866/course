<?php

namespace App\Livewire\Dashboard\Setting;

use App\Models\Courses;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;

class NewSlider extends Component
{

    use WithFileUploads, ImageProcessing;

    protected $listeners = ['edit' => 'edit'];
    public $name,$image,$imageold,$edit=false,$id,$header,$course_id;
    public function edit($id = null)
    {
        if ($id != null) {
            $this->image = null;
            $CC = Slider::find($id);
            $this->id = $id;
            $this->imageold = $CC->img !=null? $CC->imageurl:null;
            $this->course_id = $CC->course_id;
            $this->edit = true;
            $this->header = __('tran.editslider');
        }else{
          $this->imageold =null;
          $this->course_id =null;
          $this->image =null;
          $this->edit = false;
          $this->header = __('tran.newslider');
        }
        $this->dispatch('openmodel');
    }
    protected $rules = [
        'image' => 'required',

    ];

    public function save()
    {

        if( $this->edit == true){
            $CC = Slider::find($this->id);
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false, null,null,'slider',472,800);
                $CC->img =  $dataX['image'];
            }
            $CC->course_id=$this->course_id ;
        }else{
            $this->validate();
            $CC = Slider::create([]);
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false, null,null,'slider',472,800);
                $CC->img =  $dataX['image'];
            }
            $CC->course_id=$this->course_id ;
        }
        $CC->save();
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('slider_refresh');
        $this->reset('image');

    }
    public function render()
    {
        $courses= Courses::get();

        return view('dashboard.setting.new-slider',compact('courses'));
    }
}
