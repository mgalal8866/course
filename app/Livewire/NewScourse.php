<?php

namespace App\Livewire;

use App\Models\Quizes;
use App\Models\Stages;
use App\Models\Courses;
use App\Models\Lessons;
use Livewire\Component;
use App\Models\CourseStages;
use App\Models\CategoryExams;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;
use App\Models\Quiz_questions;
use App\Models\Quiz_question_answers;
use Illuminate\Support\Facades\DB;

class NewScourse extends Component
{


    use WithFileUploads, ImageProcessing;



    protected $listeners = ['edit' => 'edit', 'fetchdata' => 'fetchdata','setTrainingId'];
    public $nameinput,$course_id, $courses, $stage_child_id, $stages_id, $stage_child = [], $stages = [], $redirect_mark, $redirect_to_up, $redirect_to_down, $typecategory, $image,
        $questions = [],
        $category = [], $testname, $testcategory, $testtime, $degree_success, $total_scores;

        public function setTrainingId($name)
        {
            $this->nameinput =$name;
        }
    public function render()
    {

        return view('new-scourse');
    }
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
        
        DB::beginTransaction();
        try {
            $quiz = Quizes::create([
                'name'          => $this->testname,
                'category_id'   => $this->testcategory,
                'time'          => $this->testtime,
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
                $countquiz =  Quiz_questions::where( 'quiz_id',$quiz->id)->count();
                $question =   Quiz_questions::create([
                    'quiz_id'  => $quiz->id,
                    'description' => $i['description'],
                    'question' => $i['question'],
                    'mark'   => $i['degree'],
                    'sort'   =>   $countquiz+1 ,

                ]);
                foreach ($i['answers'] as $index2 => $ii) {
                    Quiz_question_answers::create([
                        'question_id' => $question->id,
                        'answer'     => $ii['answer'],
                        'sort'     => $ii['sort'],
                        'correct'    => ($index2 == $i['correct']) ? 1 : 0,
                    ]);
                }
                // dd($this->questions );
            }
            DB::commit();
            $this->dispatch('setquizid',  quizid:  $quiz->id,name:$this->nameinput);
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
}
