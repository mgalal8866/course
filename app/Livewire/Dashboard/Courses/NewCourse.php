<?php

namespace App\Livewire\Dashboard\Courses;


use App\Models\Category;
use Livewire\Component;

class NewCourse extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $name,$email, $edit = false, $id, $header, $currentPage = 1;

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
    private  $validtionRules = [
        1 => [
            'name' => 'required|min:3',
            'email' => 'required',
        ],
        2=> [''=>''], 3 => [''=>''], 4=> [''=>'']

    ];

    public function updated($propertyName)
    {
      $this->validateOnly($propertyName,$this->validtionRules[$this->currentPage]);
    }

    public function goToNextPage()
    {
        $this->validate($this->validtionRules[$this->currentPage]);
        $this->currentPage++;
    }
    public function goToPage($pg)
    {
        $this->currentPage ==$pg;
    }
    public function goToPerviousPage()
    {
        $this->currentPage--;
    }
    public function save()
    {
        $rules = collect($this->validtionRules)->collect()->toArray();
        $this->validate($rules);




        $this->resetValidation();
        $this->reset();
    }
    public function render()
    {
        return view('dashboard.courses.new-course');
    }
}
