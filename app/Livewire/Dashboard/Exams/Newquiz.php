<?php

namespace App\Livewire\Dashboard\Exams;

use App\Models\CategoryExams;
use Livewire\Component;

class Newquiz extends Component
{
    public $quetions,$answers ;
    public function mount()
    {
        $this->fill(['quetions' => collect([['quetion' => '',
        'degree' => '',
        'answers'=>collect([['answer' => 'aaa']])

        ]])]);
    }
    public function addquetions()
    {
        $this->quetions ->push(['quetion' => '', 'degree' => '','answers'=>collect([['answer' => 'aaa']])]);
    }
    public function removequetions($key)
    {
        if ($this->quetions->count() != 1)
            $this->quetions->pull($key);
    }
    public function addanswerquetions($key)
    {
        $this->quetions[$key]['answers']->push(['answer' => '1111']);
    }
    public function  removeanswerquetions($key,$key1)
    {
        $this->quetions[$key]['answers']->pull($key1);
    }

    public function render()
    {
        $category = CategoryExams::get();
        return view('dashboard.exams.newquiz',compact('category'));
    }
}
