<?php

namespace App\Livewire\Dashboard\Setting;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;

class NewSlider extends Component
{

    use WithFileUploads, ImageProcessing;

    protected $listeners = ['edit' => 'edit'];
    public $name,$image,$imageold,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {
            $this->image = null;
            $CC = Slider::find($id);
            $this->id = $id;
            $this->imageold = $CC->img !=null? $CC->imageurl:null;
            $this->edit = true;
            $this->header = __('tran.editslider');
        }else{
          $this->imageold =null;
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

        $this->validate();
        if( $this->edit == true){
            $CC = Slider::find($this->id);
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false, null,null,'slider',472,800);
                $CC->img =  $dataX['image'];
            }
            $CC->save();
        }else{
            $CC = Slider::create([]);
            if($this->image !=null){
                $dataX = $this->saveImageAndThumbnail($this->image, false, null,null,'slider',472,800);
                $CC->img =  $dataX['image'];
            }
            $CC->save();
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('slider_refresh');
        $this->reset('image');

    }
    public function render()
    {
        return view('dashboard.setting.new-slider');
    }
}
