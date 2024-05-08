<?php

namespace App\Livewire\Dashboard\Courses;


use App\Models\User;
use App\Models\Quizes;
use App\Models\Stages;
use App\Models\Courses;
use App\Models\Lessons;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Category;
use App\Models\FreeCourse;
use Livewire\Attributes\On;
use App\Models\CourseStages;
use Livewire\WithFileUploads;
use App\Models\CourseTrainers;
use App\Models\Quiz_questions;
use App\Models\CategoryFCourse;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz_question_answers;
use function Livewire\Volt\state;
class NewCourse extends Component
{
    use WithFileUploads, ImageProcessing;

    protected $listeners = ['funquestion' => 'funquestion', 'edit' => 'edit', 'refreshDropdown', 'currentPage' => 'currentPage'];
    public $edit = false, $short_description, $id, $header, $currentPage = 3, $pages = 4, $conditions, $target, $howtostart,
        $telegram, $telegramgrup, $nextcourse, $course_gender, $schedule, $free_tatorul, $nextcoursesbycat,
        $name, $description, $validity = 'تبقى الدورة بكامل محتوياتها ثلاثة أشهر بحساب المتدرب.', $category_id, $price, $pricewith = 1, $startdate, $enddate, $time, $features, $triner = [], $limit_stud, $duration_course = 'شهر ونصف',
        $image_course, $file_work, $file_explanatory, $file_aggregates, $file_supplementary, $file_free, $file_test,
        $langcourse = false, $status = true, $inputnum = false, $lessons, $stages, $answer_the_question, $calc_rate;
    public $questions =[], $total_scores, $degree_success, $testname, $testtime, $sections_guide;
    public function cancelq( $id)
    {
        if(count($this->questions) > 0){

            $this->questions->pull($id);
        }
    
    }

    public function mount()
    {

        $this->stages = Stages::parentonly()->orderBy('parent_id', 'DESC')->get();
        $this->fill(['lessons' => collect([['stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => 1, 'publish_at' => null]])]);
    }
    public function updated($propertyName)
    {
        // dd($this->file_work);
        // $this->validateOnly($propertyName, $this->validtionRules[$this->currentPage]);
    }


    //############### Start validtion ###############
    public function messages(): array
    {
        return [
            'testname.required'            => 'مطلوب اسم الاختبار',
            'testtime.required'     => 'وقت الاختبار مطلوب',
            'total_scores.required'           => 'اجمالى الدرجات مطلوب',
            'degree_success.required'           => 'درجه النجاح مطلوب',
            'questions.*.question.required'           => 'ألسؤال مطلوب',
            'questions.*.degree.required'            => 'درجه السؤال مطلوب',
            'questions.*.answers.required'           => 'required',
            'questions.*.answers.*.answer'  => 'required',
            'questions.*.answers.*.correct' => 'required',
            'target.required' => 'اهداف الدورة مطلوبة',
            'name.required'            => 'اسم الدوره مطلوب',
            'category_id.required'     => 'حقل الاقسام مطلوب',
            'price.required'           => 'حقل السعر مطلوب',
            'pricewith.required'           => 'حقل شامل السعر مطلوب',
            'startdate.required'       => 'تاريخ البدا مطلوب',
            'enddate.required'         => 'تاريخ الانتهاء مطلوب',
            'time.required'            => 'الوقت مطلوب',
            'features.required'        => 'المميزات مطلوب',
            'howtostart.required'        => 'كيف البدا مطلوب',
            'target.required'        => 'الاهداف مطلوب',
            'conditions.required'        => 'الشروط والاحكام مطلوبه',
            'short_description.required'        => 'نبذه مختصره مطلوبة',
            'description.required'        => 'نبذه مطلوبة',
            'triner.required'          => 'المدربون مطلوب',
            'limit_stud.required'      => 'عدد المقاعد مطلوب',
            'validity.required' => 'صلاحية الدوره مطلوب',
            'duration_course.required' => 'مده الدوره مطلوب',
            'image_course.required' => ' صورة الدورة مطلوبه',
            'schedule.required' => 'جدول الدورة مطلوب',
            // 'free_tatorul.required' => 'الشرح المجانى مطلوب',
            'lessons.*.name.required' => 'اسم الشرح مطلوب',
            'lessons.*.link.required' => 'الرابط مطلوب',
            'lessons.*.stage_id.required' => 'المرحلة مطلوب ',
        ];
    }
    private  $validtionRules = [
        1 => [
            'name'            => 'required',
            'category_id'     => 'required|exists:categories,id',
            'price'           => 'required',
            'pricewith'           => 'required',
            'startdate'       => 'required|date_format:Y/m/d',
            'enddate'         => 'required|date_format:Y/m/d',
            'time'            => 'required',
            'features'        => 'required',
            'howtostart'        => 'required',
            'target'        => 'required',
            'conditions'        => 'required',
            'short_description'        => 'required',
            'description'        => 'required',
            'triner'          => 'required',
            'limit_stud'      => 'required|integer',
            'validity' => 'required',
            'duration_course' => 'required',
        ],
        2 => [
            'image_course' => 'required',
            'schedule' => 'required',
            'file_work' => '',
            'file_explanatory' => '',
            'file_aggregates' => '',
            'file_supplementary' => '',
            'file_free' => '',
            'file_test' => ''
        ],
        3 => [
            'lessons.*.name' => 'required',
            'lessons.*.link' => 'required',
            'lessons.*.stage_id' => 'required',
            'lessons.*.publish_at' => 'required',
        ],

    ];
    private  $validtionRules2 = [
        'testname'                              => 'required',
        'testtime'                      => 'required',
        'total_scores'                              => 'required',
        'degree_success'                            => 'required',
        'questions.*.question'                              => 'required',
        'questions.*.degree'            => 'required',
    ];
    //############### End validtion ###############

    //############## Start Questions ################

    public function updatedQuestions($value, $nested)
    {
          $nestedData = explode(".", $nested);
        // dd( $nestedData  );

    }
    public function addquestions()
    {
        if(empty($this->questions)){
            $this->fill(['questions' => collect([[
                'question' => '',
                'testdescription' => '',
                'degree' => '',
                'correct' => '',
                'answers' => collect([['answer' => '']])

            ]])]);
        }else{
            $this->questions->push(['question' => '', 'testdescription' => '', 'degree' => '', 'correct' => '','answers' => collect([['answer' => '']])]);
        }
        // dd( $this->questions);
        $this->dispatch('funquestion',key: ($this->questions->keys()->last()-1));
    }
    public function removequestions($key)
    {
        if ($this->questions->count() != 1)
            $this->questions->pull($key);
    }
    public function addanswerquestions($key)
    {
        $this->questions[$key]['answers']->push(['answer' => '']);
    }
    public function  removeanswerquestions($key, $key1)
    {
        $this->questions[$key]['answers']->pull($key1);
    }

    public function  savequti($key)
    {
        $this->validate($this->validtionRules2);

        DB::beginTransaction();
        try {
            $quiz = Quizes::create([
                'name'          => $this->testname ?? null,
                'category_id'   => $this->testcategory ?? null,
                'time'          => $this->testtime ?? null,
                'pass_marks'    => $this->degree_success ?? null,
                'total_marks'   => $this->total_scores ?? null,
            ]);
            foreach ($this->questions as $i) {
                $question =   Quiz_questions::create([
                    'quiz_id'  => $quiz->id,
                    'description' => $i['testdescription'],
                    'question' => $i['question'],
                    'mark'   => $i['degree'],
                ]);
                foreach ($i['answers'] as $index2 =>$ii) {
                    Quiz_question_answers::create([
                        'question_id' => $question->id,
                        'answer'     => $ii['answer'],
                        'correct'    =>  ($index2 ==$i['correct']) ? 1 : 0,
                    ]);
                }
            }
            $d = $quiz->id;
            $this->dispatch('closemodel', key: $key);
            $this->dispatch('swal', message: 'تم انشاء التدريب بنجاح');
            DB::commit();
            $this->editw($key, $d);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
        }
    }
    //############## End Questions ################

    //################ Start Lesson ################
    public function updatedCategoryId($value)
    {
        $this->nextcoursesbycat = Courses::whereCategoryId($value)->get();
    }
    public function addlesson()
    {
        $this->lessons->push(['stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => 1, 'publish_at' => null]);
    }
    public function removelesson($key)
    {
        if ($this->lessons->count() != 1)
            $this->lessons->pull($key);
    }
    public function editw($key, $val)
    {
        // if (isset($this->lessons[$key])) {
        //     $this->lessons[$key]['link'] = $val;
        // }
        $this->lessons = $this->lessons->map(function ($object, $k) use ($val, $key) {

            if ($k == $key) {
                $object['link'] = $val;
                return $object;
            }
            return $object;
        });

        // dd($this->lessons);
    }
    //################ End Lesson ################

    //############## End Questions ##############
    //############## start Page #################
    public function goToNextPage()
    {

        $this->validate($this->validtionRules[$this->currentPage]);
        $this->currentPage++;
    }
    public function goToPage($pg)
    {
        // $this->currentPage == $pg;
    }
    public function goToPerviousPage()
    {
        $this->currentPage--;
    }
    //############### End Page ###############

    //############### Start Course ###############
    public function save()
    {
        DB::beginTransaction();
        try {
            $rules = collect($this->validtionRules)->collect()->toArray();
            // $this->validate($rules);
            $CFC = Courses::updateOrCreate(['id' => $this->id], [
                'name'         => $this->name,
                'duration'     => $this->duration_course ?? null,
                'validity'     => $this->validity ?? null,
                'course_gender'     => $this->course_gender ?? null,
                'short_description'  => $this->short_description ?? null,
                'description'  => $this->description ?? null,
                'category_id'  => $this->category_id ?? null,
                'price'        => $this->price ?? null,
                'pricewith'    => $this->pricewith ?? null,
                'start_date'   => $this->startdate ?? null,
                'end_date'     => $this->enddate ?? null,
                'time'         => $this->time ?? null,
                'max_drainees' => $this->limit_stud ?? null,
                'conditions'   => $this->conditions ?? null,
                'features'    => $this->features ?? null,
                'sections_guide'    => $this->sections_guide ?? null,
                'how_start'    => $this->howtostart ?? null,
                'target'       => $this->target ?? null,
                'telegramgrup' => $this->telegramgrup ?? null,
                'telegram'     => $this->telegram ?? null,
                'next_cource'  => $this->nextcourse ?? null,
                'free_tatorul'  => $this->free_tatorul ?? null,
                'lang'         => ($this->langcourse = true) ? 1 : 0,
                'statu'        => ($this->status = true) ? 1 : 0,
                'inputnum'     => ($this->inputnum = true) ? 1 : 0,
                'file_free'    => $this->file_free ?? null,
                'answer_the_question'    => $this->answer_the_question ?? null,

            ]);
            if ($this->calc_rate) {
                $dataX = $this->saveImageAndThumbnail($this->calc_rate, false, $CFC->id, 'courses', 'images');
                $CFC->calc_rate =  $dataX['image'];
            }
            if ($this->image_course) {
                $dataX = $this->saveImageAndThumbnail($this->image_course, false, $CFC->id, 'courses', 'images');
                $CFC->image =  $dataX['image'];
            }
            if ($this->schedule) {
                $file =  uploadfile($this->schedule, "files/courses/"  . $CFC->id . "/doc");
                $CFC->schedule =  $file;
            }

            if ($this->file_work) {
                $file =  uploadfile($this->file_work, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_work = $file;
            }
            if ($this->file_explanatory) {
                $file =  uploadfile($this->file_explanatory, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_explanatory =  $file;
            }
            if ($this->file_aggregates) {
                $file =  uploadfile($this->file_aggregates, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_aggregates =  $file;
            }
            if ($this->file_supplementary) {
                $file =  uploadfile($this->file_supplementary, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_supplementary =  $file;
            }
            if ($this->file_free) {
                $file =  uploadfile($this->file_free, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_free =  $file;
            }

            if ($this->file_test) {
                $file =  uploadfile($this->file_test, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_test =  $file;
            }
            $CFC->save();
            foreach ($this->triner as $i) {
                $CFC->coursetrainers()->create(['trainer_id' => $i]);
            }
            foreach ($this->lessons as $i) {
                if ($i['is_lesson'] == 0) {
                    Quizes::updated(['id' => $i['link']], ['course_id' => $CFC->id]);
                }

                $lesson = Lessons::create(['name' => $i['name'], 'link_video' => $i['link'], 'is_lesson' => $i['is_lesson'], 'publish_at' => $i['publish_at']]);
                $CFC->stages()->attach($i['stage_id'], ['course_id' => $CFC->id, 'lesson_id' => $lesson->id]);
            }
            DB::commit();
            $this->dispatch('swal', message: 'تم انشاء الدورة بنجاح');

            return  redirect()->route('course');
            // $this->resetValidation();
            // $this->reset();
            // return true;

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            // return false;
        }
    }
    //############## End Course ##################


    // public function mount()
    // {
    //     $this->fill(['questions' => collect([[
    //         'question' => '',
    //         'degree' => '',
    //         'answers' => collect([['answer' => '']])

    //     ]])]);
    // }
    // public function  removeanswerquestions($key, $key1)
    // {
    //     $this->questions[0]['answers']->pull($key1);
    // }
    // public function addquestions()
    // {
    //     $this->questions->push(['question' => '', 'degree' => '', 'answers' => collect([['answer' => '']])]);
    // }
    // public function addanswerquestions($key)
    // {
    //     $this->questions[0]['answers']->push(['answer' => '']);
    // }

    public function render()
    {
        $category = Category::get();
        $triners = User::whereType('1')->get();
        $categoryfreecourse = CategoryFCourse::whereHas('freecourse')->get();
        return view('dashboard.courses.new-course', compact(['category', 'triners', 'categoryfreecourse']));
    }
}
