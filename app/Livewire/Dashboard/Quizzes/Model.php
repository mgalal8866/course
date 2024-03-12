<?php

namespace App\Livewire\Dashboard\Quizzes;


use Livewire\Component;
use App\Models\CategoryExams;
use App\Models\Quiz_question_answers;
use App\Models\Quiz_questions;
use App\Models\Quizes;
use Illuminate\Support\Facades\DB;

class Model extends Component
{
    public $header = 1, $questions;
    public function mount()
    {
        $this->fill(['questions' => collect([[
            'question' => '',
            'degree' => '',
            'answers' => collect([['answer' => '', 'correct' => '']])

        ]])]);
    }
    public function  removeanswerquestions($key, $key1)
    {
        $this->questions[0]['answers']->pull($key1);
    }
    public function addquestions()
    {
        $this->questions->push(['question' => '', 'degree' => '', 'answers' => collect([['answer' => '', 'correct' => '']])]);
    }
    public function addanswerquestions($key)
    {
        $this->questions[0]['answers']->push(['answer' => '', 'correct' => '']);
    }
    public function render()
    {
        return view('dashboard.quizzes.model');
    }
}
