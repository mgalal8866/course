<?php

namespace App\Livewire\Dashboard\FreeCourse;

use App\Models\CategoryFCourse;
use App\Models\FreeCourse;
use Livewire\Component;

class NewFreeCourse extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $name,$link, $image, $category_id, $category, $edit=false,$id,$header;
    public function edit($id = null)
    {
        $this->dispatch('openmodel');
        if ($id != null) {
            $FC = FreeCourse::find($id);
            $this->name        = $FC->name;
            $this->category_id = $FC->category_id;
            $this->image       = $FC->image;
            $this->link        = $FC->video_link;
            $this->id          = $id;
            $this->edit = true;
            $this->header = __('tran.editfreecourse');
        }else{
            $this->name = null;
            $this->link = null;
            $this->image = null;
            $this->category_id = null;
            $this->category = null;
            $this->edit = false;
            $this->header = __('tran.newfreecourse');}
    }
    protected $rules = [
        'name'         => 'required',
        'category_id'  => 'nullable|required',
        'image'        => 'required',
        'link'         => 'required',

    ];

    public function save()
    {
        $this->validate();
        if( $this->edit == true){
            $CFC = FreeCourse::find($this->id);
            $CFC->update(['name' => $this->name]);
        }else{

            FreeCourse::create([
                'name'        => $this->name,
                'category_id' => $this->category_id,
                'image'       => $this->image,
                'video_link'  => $this->link,
            ]);
        }
        $this->dispatch('closemodel');
        $this->dispatch('rFreeCourse');
        $this->reset('name');
        $this->edit = false;

    }
    public function render()
    {
        $this->category =  CategoryFCourse::get();
        return view('dashboard.free-course.new-free-course');
    }
}
