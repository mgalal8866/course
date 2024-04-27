<?php

namespace App\Livewire\Dashboard\Quizzes;


use Livewire\Component;
use App\Models\CategoryExams;
use App\Models\Quiz_question_answers;
use App\Models\Quiz_questions;
use App\Models\Quizes;
use Illuminate\Support\Facades\DB;

class Forcoursemodel extends Component
{
    public $header = 1;

    public function render()
    {
        return view('dashboard.quizzes.forcoursemodel');
    }
}
