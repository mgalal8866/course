<?php

namespace App\Livewire\Dashboard\Courses;


use App\Models\User;

use App\Models\Stages;
use App\Models\Courses;
use App\Models\Lessons;

use Livewire\Component;
use App\Models\Category;

use App\Models\CourseStages;
use Livewire\WithFileUploads;

use App\Models\CategoryFCourse;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class NewCourse extends Component
{
    use WithFileUploads, ImageProcessing;

    protected $listeners = ['funquestion' => 'funquestion', 'edit' => 'edit', 'refreshDropdown', 'currentPage' => 'currentPage'];
    public  $edit = false, $short_description, $id, $header, $currentPage = 1, $pages = 2, $conditions, $target, $howtostart,
        $telegram, $telegramgrup, $nextcourse, $course_gender, $schedule, $free_tatorul, $nextcoursesbycat,
        $name, $description, $validity = 'تبقى الدورة بكامل محتوياتها ثلاثة أشهر بحساب المتدرب.', $category_id, $price, $pricewith = 1, $startdate, $enddate, $time, $features, $triner = [], $limit_stud, $duration_course = 'شهر ونصف',
        $image_course, $file_work, $file_explanatory, $file_aggregates, $file_supplementary, $file_free, $file_test,
        $langcourse = false, $status = true, $inputnum = false, $stages, $answer_the_question, $calc_rate;
    public $questions = [], $total_scores, $degree_success, $testname, $testtime, $sections_guide;
    public Collection $lessons;

    public $showParentModal = false;
    public $showChildModal = false;


    public function edit($id = null)
    {

        $this->dispatch('openmodeleditUser');
    }



    public function mount()
    {
        $this->lessons = collect();
        if (request()->query('step', null) != null) {
            $this->currentPage  = request()->query('step', null);
        }

        $this->stages = Stages::parentonly()->orderBy('parent_id', 'DESC')->get();
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



    //################ Start Lesson ################
    public function updatedCategoryId($value)
    {
        $this->nextcoursesbycat = Courses::whereCategoryId($value)->get();
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
        // dd( $this->edit , $this->short_description, $this->id, $this->header, $this->currentPage = 1, $this->pages = 2, $this->conditions, $this->target, $this->howtostart,
        // $this->telegram, $this->telegramgrup, $this->nextcourse, $this->course_gender, $this->schedule, $this->free_tatorul, $this->nextcoursesbycat,
        // $this->name, $this->description, $this->validity = 'تبقى الدورة بكامل محتوياتها ثلاثة أشهر بحساب المتدرب.', $this->category_id, $this->price, $this->pricewith = 1, $this->startdate, $this->enddate, $this->time, $this->features, $this->triner = [], $this->limit_stud, $this->duration_course = 'شهر ونصف',
        // $this->image_course, $this->file_work, $this->file_explanatory, $this->file_aggregates, $this->file_supplementary, $this->file_free, $this->file_test,
        // $this->langcourse = false, $this->status = true, $this->inputnum = false, $this->stages, $this->answer_the_question, $this->calc_rate, $this->questions = [], $this->total_scores, $this->degree_success, $this->testname, $this->testtime, $this->sections_guide);
        DB::beginTransaction();
        try {
            $rules = collect($this->validtionRules)->collect()->toArray();
            // $this->validate($rules);
            if ($this->howtostart != '') {
                $howtostart = replaceimageeditor($this->howtostart);
            }
            if ($this->features != '') {
                $features = replaceimageeditor($this->features);
            }
            if ($this->conditions != '') {
                $conditions = replaceimageeditor($this->conditions);
            }
            if ($this->description != '') {
                $description = replaceimageeditor($this->description);
            }
            if ($this->target != '') {
                $target = replaceimageeditor($this->target);
            }
            if ($this->answer_the_question != '') {
                $answer_the_question = replaceimageeditor($this->answer_the_question);
            }
            if ($this->sections_guide != '') {
                $sections_guide = replaceimageeditor($this->sections_guide);
            }

            $CFC = Courses::updateOrCreate(['id' => $this->id], [
                'name'         => $this->name,
                'duration'     => $this->duration_course ?? null,
                'validity'     => $this->validity ?? null,
                'course_gender'     => $this->course_gender ?? null,
                'short_description'  => $this->short_description ?? null,
                'description'  => $description ?? null,
                'category_id'  => $this->category_id ?? null,
                'price'        => $this->price ?? null,
                'pricewith'    => $this->pricewith ?? null,
                'start_date'   => $this->startdate ?? null,
                'end_date'     => $this->enddate ?? null,
                'time'         => $this->time ?? null,
                'max_drainees' => $this->limit_stud ?? null,
                'conditions'   => $conditions ?? null,
                'features'    => $features ?? null,
                'sections_guide'    => $sections_guide ?? null,
                'how_start'    => $howtostart?? null,
                'target'       => $target ?? null,
                'telegramgrup' => $this->telegramgrup ?? null,
                'telegram'     => $this->telegram ?? null,
                'next_cource'  => $this->nextcourse ?? null,
                'free_tatorul'  => $this->free_tatorul ?? null,
                'lang'         => ($this->langcourse = true) ? 1 : 0,
                'statu'        => ($this->status = true) ? 1 : 0,
                'inputnum'     => ($this->inputnum = true) ? 1 : 0,
                'file_free'    => $this->file_free ?? null,
                'answer_the_question'    => $answer_the_question?? null,

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

            DB::commit();
            $this->dispatch('swal', message: 'تم انشاء الدورة بنجاح');

            return  redirect()->route('newcourse2')->with('course_id',  $CFC->id);
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

    public function updateTaskOrder($orderedIds)
    {
        $this->lessons = collect($orderedIds)->map(function ($id) {
            return collect($this->lessons)->firstWhere('id', $id);
        })->toArray();
    }

    public function addlesson()
    {
        if(count($this->lessons)  == 0){
            $this->fill(['lessons' => collect([['per' => count($this->lessons) +1,'lessons_id' => null,'stage_id' => null, 'img' => null, 'name' => null, 'link' => null, 'is_lesson' => 1, 'publish_at' => null]])]);

        }else{

            $this->lessons->push(['per' => (count($this->lessons) +1),'lessons_id' => null,'stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => 1, 'publish_at' => null]);
        }

    }
    public function removelesson($key)
    {

        if ($this->lessons->count() != 1){
            CourseStages::where(['stage_id'=>$this->lessons[$key]['stage_id'],'lesson_id'=>$this->lessons[$key]['lessons_id']])->delete();
            Lessons::where(['id'=>$this->lessons[$key]['lessons_id']])->delete();
            $this->lessons->pull($key);
        }
    }
    public function render()
    {
        $category = Category::get();
        $triners = User::whereType('1')->get();
        $categoryfreecourse = CategoryFCourse::whereHas('freecourse')->get();
        return view('dashboard.courses.new-course', compact(['category', 'triners', 'categoryfreecourse']));
    }
}
