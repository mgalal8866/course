<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\User;
use App\Models\Quizes;
use App\Models\Stages;
use App\Models\Country;
use App\Models\Courses;
use App\Models\Lessons;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Category;
use App\Models\CourseStages;
use Livewire\WithFileUploads;
use App\Models\Quiz_questions;
use App\Models\CategoryFCourse;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz_question_answers;

class EditCourse extends Component
{
    use WithFileUploads, ImageProcessing;

    public $questions, $image_course_old, $calc_rate,  $calc_rate_old, $answer_the_question, $sections_guide, $short_description, $id, $header, $currentPage = 1, $pages = 4, $conditions, $target, $howtostart,
        $telegram, $telegramgrup, $nextcourse, $course_gender, $schedule, $free_tatorul, $nextcoursesbycat,
        $name, $description, $validity = 'تبقى الدورة بكامل محتوياتها ثلاثة أشهر بحساب المتدرب.', $country_id, $category_id, $price, $pricewith, $startdate, $enddate, $time, $features, $triner = [], $limit_stud, $duration_course = 'شهر ونصف',
        $image_course, $file_work, $file_explanatory, $file_aggregates, $file_supplementary, $file_free, $file_test,
        $langcourse, $status, $inputnum, $lessons = [], $stages;
    public function mount($id = null)
    {
        $this->fill(['questions' => collect([[
            'question' => '',
            'testdescription' => '',
            'degree' => '',
            'correct' => '',
            'answers' => collect([['answer' => '', 'correct' => '']])

        ]])]);
        $this->stages = Stages::orderBy('parent_id', 'DESC')->get();

        $this->id = $id;
        $course = Courses::with(['lessons', 'coursetrainers','coursestages'])->find($this->id);

        $this->short_description     = $course->short_description ?? '';
        $this->conditions            = $course->conditions ?? '';
        $this->target                = $course->target ?? '';
        $this->howtostart            = $course->how_start ?? '';
        $this->telegram              = $course->telegram ?? '';
        $this->telegramgrup          = $course->telegramgrup ?? '';
        $this->nextcourse            = $course->nextcourse ?? '';
        // $this->calc_rate            = $course->calc_rateurl??'';
        $this->calc_rate_old            = $course->calc_rateurl ?? '';
        $this->course_gender         = $course->course_gender ?? '';
        $this->schedule              = $course->schedule ?? '';
        $this->free_tatorul          = $course->free_tatorul ?? '';
        // $this->nextcoursesbycat      = $course->nextcoursesbycat??'';
        $this->name                  = $course->name ?? '';
        $this->description           = $course->description ?? '';
        $this->validity              = $course->validity ?? '';
        $this->country_id            = $course->country_id ?? '';
        $this->category_id           = $course->category_id ?? '';
        $this->price                 = $course->price ?? '';
        $this->pricewith             = $course->pricewith ?? '';
        $this->startdate             = $course->start_date ?? '';
        $this->enddate               = $course->end_date ?? '';
        $this->time                  = $course->time ?? '';
        $this->features              = $course->features ?? '';
        $this->triner                = $course->coursetrainers ? $course->coursetrainers->pluck('trainer_id')->toarray() : [];
        $this->limit_stud            = $course->max_drainees;
        $this->duration_course       = $course->duration;
        $this->image_course_old      = $course->imageurl;
        $this->file_work             = $course->file_work;
        $this->file_explanatory      = $course->file_explanatory;
        $this->file_aggregates       = $course->file_aggregates;
        $this->file_supplementary    = $course->file_supplementary;
        $this->file_free             = $course->file_free;
        $this->file_test             = $course->file_test;
        $this->langcourse            = $course->langcourse == 1 ? true : false;
        $this->status                = $course->status    == 1 ? true : false;
        $this->inputnum              = $course->inputnum == 1 ? true : false;
        $this->answer_the_question  = $course->answer_the_question;
        $this->sections_guide  = $course->sections_guide;
        // $this->triner  = ["8c414fda-1e05-4543-b936-56ee3da96720"] ;

      foreach ($course->coursestages as $i => $item) {
            if ($i == 0) {
                $this->fill(['lessons' => collect([['lessons_id' => $item->lessons->id, 'stage_id' => $item->stage->id, 'img' => null, 'name' => $item->lessons->name, 'link' => $item->lessons->link_video, 'is_lesson' => $item->lessons->is_lesson, 'publish_at' => $item->lessons->publish_at]])]);
            } else {
               $this->lessons->push(['lessons_id' => $item->lessons->id, 'stage_id' => $item->stage->id, 'img' => null, 'name' => $item->lessons->name, 'link' => $item->lessons->link_video, 'is_lesson' => $item->lessons->is_lesson, 'publish_at' =>  $item->lessons->publish_at]);
            }
        }
    }
    //############## Start Questions ################
    public function addquestions()
    {
        $this->questions->push(['question' => '', 'testdescription' => '', 'degree' => '', 'answers' => collect([['answer' => '', 'correct' => '']])]);
    }
    public function removequestions($key)
    {
        if ($this->questions->count() != 1) {
            $this->questions->pull($key);
        }
    }
    public function addanswerquestions($key)
    {
        $this->questions[$key]['answers']->push(['answer' => '', 'correct' => '']);
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
                'pass_marks' => $this->degree_success ?? null,
                'total_marks'  => $this->total_scores ?? null,
            ]);
            foreach ($this->questions as $i) {
                $question =   Quiz_questions::create([
                    'quiz_id'  => $quiz->id,
                    'description' => $i['testdescription'],
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
    public function addlesson()
    {

        if (count($this->lessons)  != 0) {
            $this->lessons->push([ 'lessons_id' => null,'stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => 1, 'publish_at' => null]);

        // $this->lessons->push(['lessons_id' => null, 'stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => 1, 'publish_at' => '']);
        }else{

             $this->fill(['lessons' => collect([['lessons_id' => null, 'stage_id' => null, 'img' =>null, 'name' =>'', 'link' => '', 'is_lesson' => 1, 'publish_at' => '']])]);
        }
    }
    public function removelesson($key)
    {

        if ($this->lessons->count() != 1) {
            CourseStages::where(['stage_id' => $this->lessons[$key]['stage_id'], 'lesson_id' => $this->lessons[$key]['lessons_id']])->delete();
            Lessons::where(['id' => $this->lessons[$key]['lessons_id']])->delete();
            $this->lessons->pull($key);
        }
    }
    public function goToNextPage()
    {

        // $this->validate($this->validtionRules[$this->currentPage]);
        $this->currentPage++;
    }
    public function goToPage($pg)
    {
        // $this->currentPage == $pg;
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
    public function save()
    {
        DB::beginTransaction();
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

        try {
            $rules = collect($this->validtionRules)->collect()->toArray();
            // $this->validate($rules);
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
                'how_start'    => $howtostart ?? null,
                'target'       => $target ?? null,
                'telegramgrup' => $this->telegramgrup ?? null,
                'telegram'     => $this->telegram ?? null,
                'next_cource'  => $this->nextcourse ?? null,
                'free_tatorul'  => $this->free_tatorul ?? null,
                'lang'         => ($this->langcourse == true) ? 1 : 0,
                'statu'        => ($this->status == true) ? 1 : 0,
                'inputnum'     => ($this->inputnum == true) ? 1 : 0,
                'file_free'    => $this->file_free ?? null,
                'answer_the_question'    => $answer_the_question ?? null,

            ]);
            if ($this->calc_rate) {
                $dataX = $this->saveImageAndThumbnail($this->calc_rate, false, $CFC->id, 'courses', 'images');
                $CFC->calc_rate =  $dataX['image'];
            }
            if ($this->image_course) {
                $dataX = $this->saveImageAndThumbnail($this->image_course, false, $CFC->id, 'courses', 'images');
                $CFC->image =  $dataX['image'];
            }
            if ($this->schedule !=   $CFC->schedule) {
                $file =  uploadfile($this->schedule, "files/courses/"  . $CFC->id . "/doc");
                $CFC->schedule =  $file;
            }


            if ($this->file_work  !=   $CFC->file_work) {

                $file =  uploadfile($this->file_work, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_work = $file;
            }
            if ($this->file_explanatory !=   $CFC->file_explanatory) {
                $file =  uploadfile($this->file_explanatory, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_explanatory =  $file;
            }
            if ($this->file_aggregates !=   $CFC->file_aggregates) {
                $file =  uploadfile($this->file_aggregates, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_aggregates =  $file;
            }
            if ($this->file_supplementary !=   $CFC->file_supplementary) {
                $file =  uploadfile($this->file_supplementary, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_supplementary =  $file;
            }
            if ($this->file_free !=   $CFC->file_free) {
                $file =  uploadfile($this->file_free, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_free =  $file;
            }

            if ($this->file_test !=   $CFC->file_test) {
                $file =  uploadfile($this->file_test, "files/courses/"  . $CFC->id . "/doc");
                $CFC->file_test =  $file;
            }
            $CFC->save();
            foreach ($this->triner as $i) {
                $CFC->coursetrainers()->create(['trainer_id' => $i]);
            }
            CourseStages::where('course_id', $CFC->id)->delete();
            foreach ($this->lessons as $i) {
                if ($i['is_lesson'] == 0) {
                    Quizes::updated(['id' => $i['link']], ['course_id' => $CFC->id]);
                }


                $lesson = Lessons::updateOrCreate(['id' => $i['lessons_id']], ['name' => $i['name'], 'link_video' => $i['link'], 'is_lesson' => $i['is_lesson'], 'publish_at' => $i['publish_at']]);
                // $CFC->stages()->detach('course_id',$CFC->id);
                $CFC->stages()->attach($i['stage_id'], ['course_id' => $CFC->id, 'lesson_id' => $lesson->id]);
            }
            DB::commit();
            $this->dispatch('swal', message: 'تم تعديل الدورة بنجاح');

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
    public function goToPerviousPage()
    {
        $this->currentPage--;
    }
    public function updatedCategoryId($value)
    {
        $this->nextcoursesbycat = Courses::whereCategoryId($value)->get();
    }
    public function render()
    {

        $this->nextcoursesbycat = Courses::whereCategoryId($this->category_id)->get();
        $category = Category::get();
        $country = Country::get();
        $triners =  User::whereType(1)->latest()->get();
        $categoryfreecourse = CategoryFCourse::whereActive('1')->whereHas('freecourse')->get();
        return view('dashboard.courses.edit-course', compact(['category', 'triners', 'country', 'categoryfreecourse']));
    }
}
