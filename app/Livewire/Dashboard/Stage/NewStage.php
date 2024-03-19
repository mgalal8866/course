<?php

namespace App\Livewire\Dashboard\Stage;

use App\Models\Stages;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;

class NewStage extends Component
{
    use WithFileUploads, ImageProcessing;

    protected $listeners = ['edit' => 'edit'];
    public $stageparent=null,$name, $edit = false, $id,$parent_id, $header,$maincat,$stagesmain;
    public function mount(){


    }
    public function edit($id = null)
    {
        if ($id != null) {

            $CC = Stages::find($id);

            $this->maincat = ($CC->childrens->count() > 0);
            $this->name = $CC->name;
            $this->id = $id;
            $this->stageparent = $CC->parent_id ;
            $this->edit = true;
            $this->header = __('tran.editstage');
        } else {
            $this->name = null;
            $this->parent_id = null;
            $this->edit = false;
            $this->stageparent=null;
            $this->maincat =null;
            $this->header = __('tran.newstage');
        }
        $this->dispatch('openmodel');
    }
    protected $rules = [
        'name' => 'required',

    ];

    public function save()
    {

        $this->validate();
        if ($this->edit == true) {
            $CC = Stages::find($this->id);
            $CC->name = $this->name;
            $CC->parent_id = $this->stageparent ?? null ;
            $CC->save();
        } else {
            $CC = Stages::create(['name' => $this->name, 'parent_id' => $this->stageparent ?? null ]);

            $CC->save();
        }
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('stages_refresh');
        $this->reset('name');
    }
    public function render()
    {
        $this->stagesmain= Stages::where('parent_id',null)->get();
        return view('dashboard.stage.new-stage');
    }
}
