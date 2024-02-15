<?php

namespace App\Livewire\Dashboard\Books\Category;

use Livewire\Component;
use App\Models\CategoryBook;
use Livewire\WithFileUploads;

class NewCategory extends Component
{
    use WithFileUploads;

    protected $listeners = ['edit' => 'edit'];
    public $name,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {

            $CC = CategoryBook::find($id);
            $this->name = $CC->name;
            $this->id = $id;
            $this->edit = true;
            $this->header = __('tran.editcategory');
        }else{
          $this->name =null;
          $this->edit = false;
          $this->header = __('tran.newcategory');
        }
        $this->dispatch('openmodel');
    }
    protected $rules = [
        'name' => 'required',

    ];

    public function save()
 
    {

        $this->validate();
        if( $this->edit == true){
            $CC = CategoryBook::find($this->id);
            $CC->name = $this->name;
        }else{
            $CC = CategoryBook::create(['name' => $this->name]);
        }
        $CC->save();
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('category_book_refresh');
        $this->reset('name');

    }
    public function render()
    {
        return view('dashboard.books.category.new-category');
    }
}
