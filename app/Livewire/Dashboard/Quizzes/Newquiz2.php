<?php

namespace App\Livewire\Dashboard\Quizzes;


use App\Models\Quizes;
use App\Models\Stages;
use App\Models\Courses;
use App\Models\Lessons;
use Livewire\Component;
use App\Models\CategoryExams;
use App\Models\CourseStages;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz_questions;
use App\Models\Quiz_question_answers;

class Newquiz2 extends Component
{
    use WithFileUploads, ImageProcessing;
    protected $listeners = ['edit' => 'edit', 'fetchdata' => 'fetchdata'];
    public $course_id, $courses, $stage_child_id, $stages_id, $stage_child = [], $stages = [], $redirect_mark, $redirect_to_up, $redirect_to_down, $typecategory, $image,
        $questions = [],
        $category = [], $testname, $testcategory, $testtime, $degree_success, $total_scores;
    private   $rules = [
        // 'testname'=> 'required' ,
        // 'testcategory'=> 'required' ,
        // 'testtime'=> 'required',
        // 'degree_success'=> 'required' ,
        // 'total_scores'=> 'required',
        // 'questions' => 'required',
        // 'questions.*.question'          => 'required',
        // 'questions.*.degree'            => 'required',
        // 'questions.*.answers'           => 'required',
        // 'questions.*.answers.*.answer'  => 'required',
        // 'questions.*.correct' => 'required'

    ];
    public function edit($id = null)
    {
        $this->dispatch('openmodel');
    }
    public function updatedTypecategory($value)
    {
        if ($value != 3) {

            $this->category  = CategoryExams::where('typecategory', $value)->get();
        } else {
            $this->stages = Stages::parent()->get();
            $this->courses = Courses::get();
        }
    }
    public function updatedStagesId($value)
    {

        $this->stage_child = Stages::where('parent_id', $value)->get();
    }

    public function mount()
    {
        $this->fetchdata();
    }
    public function fetchdata()
    {
        $q =  session()->get('questions');
        if ($q != null) {
            $this->questions = $q;
        } else {
            $this->questions = [];
            // session()->put('questions',$this->questions);
        }
    }


    public function save()
    {


        // $this->validate($this->rules);

        // if ($this->questions) {
        //     $this->dispatch('swal', ['message' => 'يجب اضافة اسئلة']);
        // }
        DB::beginTransaction();

        try {
            $quiz = Quizes::create([
                'name'          => $this->testname,
                'category_id'   => $this->testcategory,
                'time'          => $this->testtime,
                'pass_marks' => $this->degree_success,
                'pass_marks' => $this->degree_success,
                'total_marks'  => $this->total_scores,
                'redirect_to_down'  => $this->redirect_to_down ?? null,
                'redirect_to_up'  => $this->redirect_to_up ?? null,
                'redirect_mark'  => $this->redirect_mark ?? null,
                'course_id' => $this->course_id ?? null
            ]);

            if ($this->typecategory == 3) {
                $lesson = Lessons::create(['name' => $this->testname, 'link_video' => $quiz->id, 'is_lesson' => 0, 'publish_at' => now()]);

                CourseStages::create(['stage_id' => $this->stage_child_id, 'course_id' => $this->course_id, 'lesson_id' => $lesson->id]);
            }

            if ($this->image) {
                $dataX = $this->saveImageAndThumbnail($this->image, false, null, null, 'Quize');
                $quiz->image =  $dataX['image'];
                $quiz->save();
            }

            foreach ($this->questions as $i) {
                if ($i['question'] != '') {
                    $qu =   replaceimageeditor($i['question']);
                }
                if ($i['description'] != '') {
                    $des =   replaceimageeditor($i['description']);
                }
                $question =   Quiz_questions::create([
                    'quiz_id'  => $quiz->id,
                    'description' => $des ?? $i['description'],
                    'question' =>  $qu ?? $i['question'],
                    'mark'   => $i['degree'],
                    'sort'   => $i['sort'],
                ]);
                foreach ($i['answers'] as $index2 => $ii) {
                    if ($ii['answer'] != '') {

                        $ans =   replaceimageeditor($ii['answer']);
                    }
                    Quiz_question_answers::create([
                        'question_id' => $question->id,
                        'answer'     =>  $ans ?? $ii['answer'],
                        'sort'   => $ii['sort'],
                        'correct'    => ($index2 == $i['correct']) ? 1 : 0,
                    ]);
                }
            }
            DB::commit();
            $this->dispatch('swal', message: 'تم انشاء  الاختبار بنجاح');
            $this->reset();
            session()->forget('questions');
            $this->dispatch('fetchdata');
            // $this->resetValidation();
            // return true;
        } catch (\Exception $e) {
            $this->dispatch('swal', message: $e->getMessage());

            // dd($e->getMessage());
            DB::rollback();
            // return false;
        }
    }
    public function render()
    {

        return view('dashboard.quizzes.newquiz2');
    }
}
