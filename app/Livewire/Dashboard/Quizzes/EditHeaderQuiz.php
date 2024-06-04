<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quiz_questions;
use Livewire\Component;

class EditHeaderQuiz extends Component
{
    public $question;
    protected $listeners = ['edit' => 'edit'];
    public function edit($id = null)
    {
      $r=   Quiz_questions::find($id);
      $this->question = $r->question ??'';
        // $this->dispatch('openmodel');
    }
    public function kk($id = null)
    {


    }
    public function render()
    {

        return view('dashboard.quizzes.edit-header-quiz');
    }
}
