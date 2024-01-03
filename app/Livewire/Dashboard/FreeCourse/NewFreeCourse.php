<?php

namespace App\Livewire\Dashboard\FreeCourse;

use App\Models\CategoryFCourse;
use App\Models\FreeCourse;
use App\Traits\ImageProcessing;
use Livewire\WithFileUploads;
use Livewire\Component;

class NewFreeCourse extends Component
{
    use WithFileUploads, ImageProcessing;
    protected $listeners = ['edit' => 'edit'];
    public $name, $link, $imagold, $image, $category_id, $category, $edit = false, $id, $header;

    protected function rules()
    {
        $rules = [
            'name'         => 'required',
            'category_id'  => 'nullable|required',
            'image'        => '',
            'link'         => 'required',
        ];
        if ($this->image) {
            $rules = array_merge($rules, [
                'image' => 'mimes:jpeg,png,jpg,gif|max:1024'
            ]);
        }
        return $rules;
    }

    public function edit($id = null)
    {
        $this->reset();
        if ($id != null) {
            $FC = FreeCourse::find($id);
            $this->name        = $FC->name;
            $this->category_id = $FC->category_id;
            $this->imagold     = $FC->imageurl;
            $this->link        = $FC->video_link;
            $this->id          = $id;
            $this->edit = true;
            $this->header = __('tran.editfreecourse');
        } else {
            $this->header = __('tran.newfreecourse');
        }
        $this->dispatch('openmodel');
    }


    public function save()
    {
        $this->validate();
        $dataX = array();
        $CFC = FreeCourse::updateOrCreate(['id' => $this->id], [
            'name'        => $this->name,
            'category_id' => $this->category_id,
            'video_link'  => $this->link,
        ]);
        if ($this->image) {
            $dataX =  $this->saveImageAndThumbnail($this->image, false, $CFC->id, 'free_courses');
            $CFC->image =  $dataX['image'];
            $CFC->save();
        }
        $this->dispatch('closemodel');
        $this->dispatch('rFreeCourse');
    }
    public function render()
    {
        $this->category =  CategoryFCourse::get();
        return view('dashboard.free-course.new-free-course');
    }
}
