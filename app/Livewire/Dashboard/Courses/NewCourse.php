<?php

namespace App\Livewire\Dashboard\Courses;


use App\Models\Country;
use App\Models\Courses;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Category;
use App\Models\CourseStages;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\CourseTrainers;
use App\Models\Stages;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;

class NewCourse extends Component
{
    use WithFileUploads, ImageProcessing;


    protected $listeners = ['edit' => 'edit', 'refreshDropdown', 'currentPage' => 'currentPage'];
    public $edit = false,$short_description, $id, $header, $currentPage = 1, $pages = 4, $conditions, $target, $howtostart,
        $telegram, $telegramgrup, $nextcourse,$course_gender,$schedule,
        $name, $description, $validity='تبقى الدورة بكامل محتوياتها ثلاثة أشهر بحساب المتدرب.', $country_id, $category_id, $price, $pricewith, $startdate, $enddate, $time, $features, $triner = [], $limit_stud, $duration_course='شهر ونصف',
        $image_course, $file_work, $file_explanatory, $file_aggregates, $file_supplementary, $file_free, $file_test,
        $langcourse, $status, $inputnum, $lessons, $stages;
    public function mount()
    {
        $this->stages = Stages::orderBy('parent_id', 'DESC')->get();
        $this->fill(['lessons' => collect([['stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'status' => true]])]);
    }

    public function addlesson()
    {
        $this->lessons->push(['stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'status' => true]);
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

        // $this->validate($this->validtionRules[$this->currentPage]);
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
    private  $validtionRules = [
        1 => [
            'name'            => 'required',
            'country_id'      => 'required|exists:countries,id',
            'category_id'     => 'required|exists:categories,id',
            'price'           => 'required',
            'startdate'       => 'required|date_format:Y/m/d',
            'enddate'         => 'required|date_format:Y/m/d',
            'time'            => 'required',
            'features'        => 'required',
            'triner'          => 'required',
            'limit_stud'      => 'required|integer',
            'duration_course' => 'required',
        ],
        2 => [
            'file_work' => '',
            'file_explanatory' => '',
            'file_aggregates' => '',
            'file_supplementary' => '',
            'file_free' => '',
            'file_test' => ''
        ],
        3 => [
            'lessons.*.img' => 'required',
            'lessons.*.name' => 'required',
            'lessons.*.link' => 'required',
        ]
    ];
    public function save()
    {
        DB::beginTransaction();
        try {
            $rules = collect($this->validtionRules)->collect()->toArray();
            // $this->validate($rules);
            $CFC = Courses::updateOrCreate(['id' => $this->id], [
                'name'         => $this->name,
                'country_id'   => $this->country_id,
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
                'lang'         => $this->langcourse ?? null,
                'statu'        => $this->status,
                'inputnum'     => $this->inputnum,
                'file_free'    => $this->file_free ?? null
            ]);
            if ($this->image_course) {
                $dataX = $this->saveImageAndThumbnail($this->image_course, false, $CFC->id, 'courses', 'images');
                $CFC->image =  $dataX['image'];
                $CFC->save();
            }
            if ($this->schedule) {
                $dataX = $this->saveImageAndThumbnail($this->schedule, false, $CFC->id, 'courses', 'images');
                $CFC->schedule =  $dataX['image'];
                $CFC->save();
            }

            if ($this->file_work) {
                $file =  uploadfile($this->file_work,"files/courses/"  . $CFC->id . "/doc");
                $CFC->file_work = $file ;
                $CFC->save();
            }
            if($this->file_explanatory){
                $file =  uploadfile($this->file_explanatory,"files/courses/"  . $CFC->id . "/doc");
                $CFC->file_explanatory =  $file;
                $CFC->save();
            }
            if($this->file_aggregates){
                $file =  uploadfile($this->file_aggregates,"files/courses/"  . $CFC->id . "/doc");
                $CFC->file_aggregates =  $file;
                $CFC->save();
            }
            if($this->file_supplementary){
                $file =  uploadfile($this->file_supplementary,"files/courses/"  . $CFC->id . "/doc");
                $CFC->file_supplementary =  $file;
                $CFC->save();
            }
            if($this->file_free){
                $file =  uploadfile($this->file_free,"files/courses/"  . $CFC->id . "/doc");
                $CFC->file_free =  $file;
                $CFC->save();
            }

            if($this->file_test){
                $file =  uploadfile($this->file_test,"files/courses/"  . $CFC->id . "/doc");
                $CFC->file_test =  $file;
                $CFC->save();
            }
            foreach ($this->triner as $i) {
                $CFC->coursetrainers()->create(['trainer_id' => $i]);
            }
            foreach ($this->lessons as $i) {
                // $dataX = $this->saveImageAndThumbnail($i['img'], false, $CFC->id, 'courses', 'lessons/image');
                // 'img' => $dataX['image'],
                $lesson = $CFC->lessons()->create(['name' => $i['name'], 'link_video' => $i['link'], 'paid' => $i['status']]);
                $CFC->stages()->attach($i['stage_id'], ['course_id' => $CFC->id, 'lesson_id' => $lesson->id]);
            }
            DB::commit();
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
        return view('dashboard.courses.new-course', compact(['category', 'triners', 'country']));
    }
}
