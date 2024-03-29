<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Stages;
use App\Models\Country;
use App\Models\Courses;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Category;
use App\Models\CategoryFCourse;

class EditCourse extends Component
{

    public $short_description, $id, $header, $currentPage = 1, $pages = 4, $conditions, $target, $howtostart,
        $telegram, $telegramgrup, $nextcourse, $course_gender, $schedule, $free_tatorul, $nextcoursesbycat,
        $name, $description, $validity = 'تبقى الدورة بكامل محتوياتها ثلاثة أشهر بحساب المتدرب.', $country_id, $category_id, $price, $pricewith, $startdate, $enddate, $time, $features, $triner = [], $limit_stud, $duration_course = 'شهر ونصف',
        $image_course, $file_work, $file_explanatory, $file_aggregates, $file_supplementary, $file_free, $file_test,
        $langcourse, $status, $inputnum, $lessons, $stages;
    public function mount($id = 'c69ebe1c-63f4-4859-89a3-ee59bf150b1b')
    {
        $this->stages = Stages::orderBy('parent_id', 'DESC')->get();
        $this->fill(['lessons' => collect([['stage_id' => null, 'img' => null, 'name' => '', 'link' => '', 'is_lesson' => true]])]);

        $this->id = $id;
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
    public function render()
    {
        $course = Courses::with(['lessons', 'coursetrainers'])->find($this->id);

        $this->short_description     = $course->short_description;
        $this->conditions            = $course->conditions;
        $this->target                = $course->target;
        $this->howtostart            = $course->howtostart;
        $this->telegram              = $course->telegram;
        $this->telegramgrup          = $course->telegramgrup;
        $this->nextcourse            = $course->nextcourse;
        $this->course_gender         = $course->course_gender;
        $this->schedule              = $course->schedule;
        $this->free_tatorul          = $course->free_tatorul;
        $this->nextcoursesbycat      = $course->nextcoursesbycat;
        $this->name                  = $course->name;
        $this->description           = $course->description;
        $this->validity              = $course->validity;
        $this->country_id            = $course->country_id;
        $this->category_id           = $course->category_id;
        $this->price                 = $course->price;
        $this->pricewith             = $course->pricewith;
        $this->startdate             = $course->startdate;
        $this->enddate               = $course->enddate;
        $this->time                  = $course->time;
        $this->features              = $course->features;
        $this->triner                = $course->coursetrainers->toarray() ?? [];
        $this->limit_stud            = $course->limit_stud;
        $this->duration_course       = $course->duration_course;
        $this->image_course          = $course->image_course;
        $this->file_work             = $course->file_work;
        $this->file_explanatory      = $course->file_explanatory;
        $this->file_aggregates       = $course->file_aggregates;
        $this->file_supplementary    = $course->file_supplementary;
        $this->file_free             = $course->file_free;
        $this->file_test             = $course->file_test;
        $this->langcourse            = $course->langcourse;
        $this->status                = $course->status;
        $this->inputnum              = $course->inputnum;
        // $this->lessons               = $course->lessons;
        foreach ($course->lessons() as $item) {

            $this->lessons->push(['stage_id' => $item->stage_id, 'img' => null, 'name' => $item->name, 'link' => $item->link, 'is_lesson' => $item->is_lesson?1:0]);
        }
        $category = Category::get();
        $country = Country::get();
        $triners = Trainer::get();
        $categoryfreecourse = CategoryFCourse::whereActive('1')->whereHas('freecourse')->get();
        return view('dashboard.courses.edit-course', compact(['category', 'triners', 'country', 'categoryfreecourse']));
    }
}
