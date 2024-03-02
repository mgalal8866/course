<?php

namespace App\Livewire\Dashboard\Courses;


use App\Models\Stages;
use App\Models\Country;
use App\Models\Courses;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Category;
use App\Models\FreeCourse;
use Livewire\Attributes\On;
use App\Models\CourseStages;
use Livewire\WithFileUploads;
use App\Models\CourseTrainers;
use App\Models\CategoryFCourse;
use App\Models\Quiz_question_answers;
use App\Models\Quiz_questions;
use App\Models\Quizes;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;

class NewCourse extends Component
{
    use WithFileUploads, ImageProcessing;


    protected $listeners = ['edit' => 'edit', 'refreshDropdown', 'currentPage' => 'currentPage'];
    public $edit = false, $short_description, $id, $header, $currentPage = 1, $pages = 4, $conditions, $target, $howtostart,
        $telegram, $telegramgrup, $nextcourse, $course_gender, $schedule, $free_tatorul, $nextcoursesbycat,
        $name, $description, $validity = 'تبقى الدورة بكامل محتوياتها ثلاثة أشهر بحساب المتدرب.', $country_id, $category_id, $price, $pricewith = 1, $startdate, $enddate, $time, $features, $triner = [], $limit_stud, $duration_course = 'شهر ونصف',
        $image_course, $file_work, $file_explanatory, $file_aggregates, $file_supplementary, $file_free, $file_test,
        $langcourse, $status=true, $inputnum, $lessons, $stages;
    public $questions, $total_scores, $degree_success, $testname, $testtime;
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
    private  $validtionRules2 = [
        'testname'                              => 'required',
        'testtime'                      => 'required',
        'total_scores'                              => 'required',
        'degree_success'                            => 'required',
        'questions.*.question'                              => 'required',
        'questions.*.degree'            => 'required',
        // 'questions.*.*.answers.*.answer' => 'required',
        // 'questions.*.*.answers.*.correct' => 'required'


    ];
    public function  savequti($key)
    {
        $this->validate($this->validtionRules2);

        DB::beginTransaction();
        try {
            $quiz = Quizes::create([
                'name'          => $this->testname ?? '',
                'category_id'   => $this->testcategory ?? '',
                'time'          => $this->testtime ?? '',
                'pass_marks' => $this->degree_success ?? '',
                'total_marks'  => $this->total_scores ?? '',
            ]);
            foreach ($this->questions as $i) {
                $question =   Quiz_questions::create([
                    'quiz_id'  => $quiz->id,
                    'question' => $i['question'],
                    'degree'   => $i['degree'],
                ]);
                foreach ($i['answers'] as $ii) {
                    Quiz_question_answers::create([
                        'question_id' => $question->id,
                        'answer'     => $ii['answer'],
                        'correct'    => $ii['correct'] == true ? 1 : 0,
                    ]);
                }
            }
            $d = $quiz->id;
            $this->dispatch('closemodel', key: $key);
            $this->dispatch('swal', message: 'تم انشاء التدريب بنجاح');

            DB::commit();

            $this->editw($key, $d);


            // $this->resetValidation();
            // $this->reset();
            // return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            // return false;
        }
    }

    public function mount()
    {
        $this->fill(['questions' => collect([[
            'question' => '',
            'degree' => '',
            'answers' => collect([['answer' => '', 'correct' => '']])

        ]])]);
        $this->stages = Stages::orderBy('parent_id', 'DESC')->get();
        $this->fill(['lessons' => collect([['stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => true, 'publish_at' => null]])]);
    }

    public function updatedCategoryId($value)
    {
        $this->nextcoursesbycat = Courses::whereCategoryId($value)->get();
    }

    public function addlesson()
    {
        $this->lessons->push(['stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => true, 'publish_at' => null]);
    }
    public function editw($key, $val)
    {
        $this->lessons = $this->lessons->map(function ($object, $k) use ($val) {
            $object['link'] = $val;
            return $object;
        });
        //  dd($this->lessons);

    }
    public function removelesson($key)
    {
        if ($this->lessons->count() != 1)
            $this->lessons->pull($key);
    }

    public function updated($propertyName)
    {
        // dd($this->file_work);
        // $this->validateOnly($propertyName, $this->validtionRules[$this->currentPage]);
    }

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
            // 'country_id.required'      => 'حقل الدولة مطلوب',
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
            'free_tatorul.required' => 'الشرح المجانى مطلوب',
            'lessons.*.name.required' => 'اسم الشرح مطلوب',
            'lessons.*.link.required' => 'الرابط مطلوب',
            'lessons.*.stage_id.required' => 'المرحلة مطلوب ',
        ];
    }
    private  $validtionRules = [
        1 => [
            'name'            => 'required',
            // 'country_id'      => 'required|exists:countries,id',
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
            'free_tatorul' => 'required',

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

    public function save()
    {
        DB::beginTransaction();
        try {
            $rules = collect($this->validtionRules)->collect()->toArray();
            // $this->validate($rules);
            $CFC = Courses::updateOrCreate(['id' => $this->id], [
                'name'         => $this->name,
                'country_id'   => $this->country_id ?? null,
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
                'how_start'    => $this->howtostart ?? null,
                'target'       => $this->target ?? null,
                'telegramgrup' => $this->telegramgrup ?? null,
                'telegram'     => $this->telegram ?? null,
                'next_cource'  => $this->nextcourse ?? null,
                'free_tatorul'  => $this->free_tatorul ?? null,
                'lang'         => $this->langcourse ?? null,
                'statu'        => ($this->status = true) ? 1 : 0,
                'inputnum'     => $this->inputnum,
                'file_free'    => $this->file_free ?? null
            ]);
            if ($this->image_course) {
                $dataX = $this->saveImageAndThumbnail($this->image_course, false, $CFC->id, 'courses', 'images');
                $CFC->image =  $dataX['image'];
            }
            if ($this->schedule) {
                $file =  uploadfile($this->schedule, "files/courses/"  . $CFC->id . "/doc");
                $CFC->schedule =  $dataX['image'];
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
                $lesson = $CFC->lessons()->create(['name' => $i['name'], 'link_video' => $i['link'], 'is_lesson' => $i['is_lesson'] != true ? 0 : 1, 'publish_at' => $i['publish_at']]);
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
    public function render()
    {
        $category = Category::get();
        $country = Country::get();
        $triners = Trainer::get();
        $categoryfreecourse = CategoryFCourse::whereActive('1')->whereHas('freecourse')->get();
        return view('dashboard.courses.new-course', compact(['category', 'triners', 'country', 'categoryfreecourse']));
    }
}
