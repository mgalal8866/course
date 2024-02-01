<?php

namespace App\Livewire\Dashboard\Setting;

use App\Models\Slider as ModelsSlider;
use Livewire\Component;

class Slider extends Component
{
    protected $listeners = ['slider_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = ModelsSlider::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = ModelsSlider::find($id);
        $CC->delete();

    }
    public function render()
    {
        $slider = ModelsSlider::get();
        return view('dashboard.setting.slider',compact('slider'));
    }
}
