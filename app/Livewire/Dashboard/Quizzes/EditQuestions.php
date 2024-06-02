<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quiz_questions;
use Livewire\Component;

class EditQuestions extends Component
{
    protected $listeners = ['edit' => 'edit'];
    public $id,$question;
    public function edit($id = null)
    {
        $this->id  =$id;
        $this->dispatch('openmodel');
        $this->question = Quiz_questions::with('answer')->find($this->id );
    }
    public function render()
    {

    //   $question = Quiz_questions::with('answer')->find('0ee56261-5b55-48a1-8e51-fa07baa017dd');

        return view('dashboard.quizzes.edit-questions');
    }
}
