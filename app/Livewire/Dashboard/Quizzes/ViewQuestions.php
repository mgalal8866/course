<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quizes;
use Livewire\Component;

class ViewQuestions extends Component
{
    public  $id;
    public function mount($id)
    {
        $this->id = $id ;
    }
    public function render()
    {
        $quiz = Quizes::where('id', $this->id )->with(['question','question.answer'])->first();

        return view('dashboard.quizzes.view-questions',compact('quiz'));
    }
}
