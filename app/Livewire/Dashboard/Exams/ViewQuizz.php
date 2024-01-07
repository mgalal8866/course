<?php

namespace App\Livewire\Dashboard\Exams;

use App\Models\Quizzes;
use Livewire\Component;

class ViewQuizz extends Component
{
    public function activetoggle($id)
    {
        $quizz = Quizzes::find($id);
        if($quizz->active == 1){
            $quizz->update(['active' => 0 ]);
        }
        else{
            $quizz->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $quizz = Quizzes::find($id);
        $quizz->delete();

    }
    public function render()
    {
        $quiz = Quizzes::latest()->get();
        return view('dashboard.exams.view-quizz',compact('quiz'));
    }
}
