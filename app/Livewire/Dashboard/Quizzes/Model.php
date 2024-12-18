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

        $this->reset();
        $answers = collect();
        for ($i = 0; $i < $this->answer_count; $i++) {
            $answers->push(['answer' => '', 'sort' => $i + 1]);
        }

        // Initialize the sort number

        $this->fill([
            'questions' => collect([
                [
                    'question' => '',
                    'description' => '',
                    'stages' => '',
                    'stage_child' => '',
                    'degree' => '',
                    'correct' => '',
                    'answers' => $answers,

                ]
            ])
        ]);
    }
    public function updatedQuestions($value, $nested)
    {
        $nestedData = explode(".", $nested);
    }
    public function removeanswerquestions($key, $key1)
    {
        $this->questions[0]['answers']->pull($key1);
    }
    public function addquestions()
    {
      
        $answers = collect();
        for ($i = 0; $i < $this->answer_count; $i++) {
            $answers->push(['answer' => '', 'sort' => $i + 1]);
        }
        $sortNumber = $this->questions->count() + 1;
        $this->questions->push([
            'question' => '',
            'description' => '',
            'degree' => '',
            'stages' => '',
            'stage_child' => '',
            'correct' => '',
            'answers' => $answers,
            'sort' => $sortNumber
        ]);
    }
    public function addanswerquestions($key)
    {
        $this->questions[0]['answers']->push(['answer' => '', 'sort' => '']);
    }
    public function save()
    {
         
        $q = session()->get('questions');
        if ($q != null) {
            $sortNumber = $q->count() + 1;
            $newQuestion = $this->questions[0]; // Get the question you want to add
            $newQuestion['sort'] = $sortNumber; // Add the sort number

            $q->push($newQuestion);
        } else {

            $this->questions->transform(function ($item, $index) {
                $item['sort'] = $index + 1; // Set the sort number
                return $item;
            });
            session()->put('questions', $this->questions);
        }
        $this->dispatch('fetchdata');
        session()->flash("success", "Your appointment sent successfully!");
    }
    public function render()
    {

        return view('dashboard.quizzes.model');
    }
}
