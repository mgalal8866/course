<?php

namespace App\Livewire\Dashboard\Courses;


use App\Models\Country;
use App\Models\Courses;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\CourseTrainers;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;

class NewCourse extends Component
{
    use WithFileUploads, ImageProcessing;


    protected $listeners = ['edit' => 'edit', 'refreshDropdown'];
    public $edit = false, $id, $header, $currentPage = 1,
        $name, $description, $country_id, $category_id, $price, $startdate, $enddate, $time, $features, $triner = [], $limit_stud, $duration_course,
        $image_course, $file_work, $file_explanatory, $file_aggregates, $file_supplementary, $file_free, $file_test,
        $langcourse, $status, $inputnum, $lessons;
    public function mount()
    {
        $this->fill(['lessons' => collect([['img' => null, 'name' => '', 'link' => '', 'status' => true]])]);
    }

    public function addlesson()
    {
        $this->lessons->push(['img' => null, 'name' => '', 'link' => '', 'status' => true]);
    }
    public function removelesson($key)
    {
        if ($this->lessons->count() != 1)
            $this->lessons->pull($key);
    }

    public  $pages = [
        1 => [
            'heading' => 'data of course',
            'subheading' => ''
        ],
        2 => [
            'heading' => '',
            'subheading' => ''
        ],
        3 => [
            'heading' => '',
            'subheading' => ''
        ],
        4 => [
            'heading' => '',
            'subheading' => ''
        ]
    ];


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
                'name'        => $this->name,
                'country_id'  => $this->country_id,
                'duration'    => $this->duration_course,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'price'       => $this->price,
                'start_date'  => $this->startdate,
                'end_date'    => $this->enddate,
                'time'        => $this->time,
                'max_drainees'  => $this->limit_stud,
                'conditions'  => '',
            ]);
            foreach ($this->triner as $i) {
                $CFC->coursetrainers()->create(['trainer_id' => $i]);
            }
            foreach ($this->lessons as $i) {
                $dataX = $this->saveImageAndThumbnail($i['img'], false, $CFC->id, 'courses','lessons/image');
                $CFC->lessons()->create(['img' => $dataX['image'] , 'name' => $i['name'], 'link_video' => $i['link'],'paid' => $i['status']]);
            }
            $this->resetValidation();
            $this->reset();
            DB::commit();
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
