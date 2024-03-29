<?php

namespace App\Livewire\Dashboard\Quizzes;


use App\Models\Quizes;
use Livewire\Component;
use App\Models\CategoryExams;
use Livewire\WithFileUploads;
use App\Models\Quiz_questions;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz_question_answers;

class Newquiz2 extends Component
{
    use WithFileUploads, ImageProcessing;
    protected $listeners = ['edit' => 'edit'];
    public $typecategory,$image, $questions, $category = [], $testname, $testcategory, $testtime, $degree_success, $total_scores;
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
            'description'=>'',
            'degree' => '',
            'answers' => collect([['answer' => '', 'correct' => '']])

        ]])]);
    }
    public function addquestions()
    {
        $this->questions->push(['question' => '','description'=>'', 'degree' => '', 'answers' => collect([['answer' => '', 'correct' => '']])]);
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
        $this->validate($this->rules);
        DB::beginTransaction();
        try {
            $quiz = Quizes::create([
                'name'          => $this->testname,
                'category_id'   => $this->testcategory,
                'time'          => $this->testtime,
                'pass_marks' => $this->degree_success,
                'pass_marks' => $this->degree_success,
                'total_marks'  => $this->total_scores,
            ]);
            if ($this->image) {
                $dataX = $this->saveImageAndThumbnail($this->image, false, null,null,'Quize');
                $quiz->image =  $dataX['image'];
                $quiz->save();
            }

            foreach ($this->questions as $i) {
                $question =   Quiz_questions::create([
                    'quiz_id'  => $quiz->id,
                    'description' => $i['description'],
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
