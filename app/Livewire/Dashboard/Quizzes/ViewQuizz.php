<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quizes;
use Livewire\Component;

class ViewQuizz extends Component
{
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
        $quiz = Quizes::latest()->get();
        return view('dashboard.quizzes.view-quizz',compact('quiz'));
    }
}
