<?php

namespace App\Livewire\Dashboard\Exams\Category;

use App\Models\CategoryExams;
use Livewire\Component;

class CategoryExam extends Component
{
    protected $listeners = ['category_exams_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $category_exams = CategoryExams::find($id);
        if($category_exams->active == 1){
            $category_exams->update(['active' => 0 ]);
        }
        else{
            $category_exams->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $category_exams = CategoryExams::find($id);
        $category_exams->delete();

    }
    public function render()
    {
        $category_exams = CategoryExams::latest()->get();
         return view('dashboard.exams.category.category-course',compact('category_exams'));
    }
}
