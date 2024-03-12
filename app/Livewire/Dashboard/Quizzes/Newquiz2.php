<?php

namespace App\Livewire\Dashboard\Quizzes;


use Livewire\Component;
use App\Models\CategoryExams;
use App\Models\Quiz_question_answers;
use App\Models\Quiz_questions;
use App\Models\Quizes;
use Illuminate\Support\Facades\DB;

class Newquiz2 extends Component
{
    protected $listeners = ['edit' => 'edit'];
    public $typecategory, $questions, $category = [], $testname, $testcategory, $testtime, $degree_success, $total_scores;
    private   $rules = [
        // 'testname'=> 'required' ,
        // 'testcategory'=> 'required' ,
        // 'testtime'=> 'required',
        // 'degree_success'=> 'required' ,
        // 'total_scores'=> 'required',
        // 'questions' => 'required',
        'questions.*.question'          => 'required',
        'questions.*.degree'            => 'required',
        'questions.*.answers'           => 'required',
        'questions.*.answers.*.answer'  => 'required',
        'questions.*.answers.*.correct' => 'required'

    ];
    public function edit($id = null)
    {
    $this->dispatch('openmodel');
}
    public function updatedTypecategory($value)
    {
        $this->category  = CategoryExams::where('typecategory', $value)->get();
    }
    public function mount()
    {
        $this->fill(['questions' => collect([[
            'question' => '',
            'degree' => '',
            'answers' => collect([['answer' => '', 'correct' => '']])

        ]])]);
    }
    public function addquestions()
    {
        $this->questions->push(['question' => '', 'degree' => '', 'answers' => collect([['answer' => '', 'correct' => '']])]);
    }
    public function removequestions($key)
    {
        if ($this->questions->count() != 1)
            $this->questions->pull($key);
    }
    public function addanswerquestions($key)
    {
        $this->questions[$key]['answers']->push(['answer' => '', 'correct' => '']);
    }
    public function  removeanswerquestions($key, $key1)
    {
        $this->questions[$key]['answers']->pull($key1);
    }
    public function save()
    {
        // $rules = collect($this->rules)->collect()->toArray();
        // dd($this->validate($rules));
        $this->validate($this->rules);
        DB::beginTransaction();
        try {
            $quiz = Quizes::create([
                'name'          => $this->testname,
                'category_id'   => $this->testcategory,
                'time'          => $this->testtime,
                'pass_marks' => $this->degree_success,
                'total_marks'  => $this->total_scores,
            ]);
            foreach ($this->questions as $i) {
                $question =   Quiz_questions::create([
                    'quiz_id'  => $quiz->id,
                    'question' => $i['question'],
                    'mark'   => $i['degree'],
                ]);
                foreach ($i['answers'] as $ii) {
                    Quiz_question_answers::create([
                        'question_id' => $question->id,
                        'answer'     => $ii['answer'],
                        'correct'    => $ii['correct'] == true ? 1 : 0,
                    ]);
                }
            }
            DB::commit();
            $this->dispatch('swal', message: 'تم انشاء  الاختبار بنجاح');

            // $this->resetValidation();
            // $this->reset();
            // return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            // return false;
        }
    }
    public function render()
    {

        return view('dashboard.quizzes.newquiz2');
    }
}
