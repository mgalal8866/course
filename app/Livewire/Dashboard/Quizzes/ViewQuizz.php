<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quizes;
use Livewire\Component;

class ViewQuizz extends Component
{
    public $selecttab=1,$quiz=[];
    public function mount()  {
        $this->quiz = Quizes::whereHas('category', function($q) {
            $q->where('typecategory', $this->selecttab);
        })->latest()->get();
    }
    public function changeselecttab($val)  {
        $this->quiz = Quizes::whereHas('category', function($q) use($val) {
            $q->where('typecategory', $val);
        })->latest()->get();
    }
    public function activetoggle($id)
    {
        $quizz = Quizes::find($id);
        if($quizz->active == 1){
            $quizz->update(['active' => 0 ]);
        }
        else{
            $quizz->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $quizz = Quizes::find($id);
        $quizz->delete();

    }
    public function render()
    {

        return view('dashboard.quizzes.view-quizz');
    }
}
