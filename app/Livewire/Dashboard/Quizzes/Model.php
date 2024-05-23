<?php

namespace App\Livewire\Dashboard\Quizzes;


use App\Models\Quizes;
use Livewire\Component;
use App\Models\CategoryExams;
use App\Models\Quiz_questions;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz_question_answers;
use App\Models\Stages;
use Illuminate\Support\Facades\Session;

class Model extends Component
{
    public $header = 1, $questions, $answer_count = 4, $stage_child = [];


    public function mount()
    {
        $answers = collect();
        for ($i = 0; $i < $this->answer_count; $i++) {
            $answers->push(['answer' => '']);
        }
        $this->fill(['questions' => collect([[
            'question' => '',
            'description' => '',
            'stages' => '',
            'stage_child' => '',
            'degree' => '', 'correct' => '',
            'answers' =>  $answers

        ]])]);
    }
    public function updatedQuestions($value, $nested)
    {
          $nestedData = explode(".", $nested);
    }
    public function  removeanswerquestions($key, $key1)
    {
        $this->questions[0]['answers']->pull($key1);
    }
    public function addquestions()
    {
        $answers = collect();
        for ($i = 0; $i < $this->answer_count; $i++) {
            $answers->push(['answer' => '']);
        }
        $this->questions->push([
            'question' => '', 'description' => '', 'degree' => '',  'stages' => '',
            'stage_child' => '', 'correct' => '', 'answers' =>  $answers
        ]);
    }
    public function addanswerquestions($key)
    {
        $this->questions[0]['answers']->push(['answer' => '']);
    }
    public function save()
    {
      
        $q =  session()->get('questions');
        if ($q != null) {
            $q->push($this->questions[0]);
        } else {
            session()->put('questions', $this->questions);
        }
        $this->dispatch('fetchdata');
        session()->flash("success", "Your appointment sent successfully!");
    }
    public function render()
    {

        return view('dashboard.quizzes.model' );
    }
}
