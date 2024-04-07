<?php

namespace App\Livewire\Dashboard\Books\Category;

use App\Models\Country;
use Livewire\Component;
use App\Models\CategoryBook;
use Livewire\WithFileUploads;

class NewCategory extends Component
{
    use WithFileUploads;

    protected $listeners = ['edit' => 'edit'];
    public $country_id, $name,$edit=false,$id,$header;
    public function edit($id = null)
    {
        if ($id != null) {

            $CC = CategoryBook::find($id);
            $this->name = $CC->name;
           $this->country_id= $CC->country_id;
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
            $CC->country_id=$this->country_id;
        }else{
            $CC = CategoryBook::create(['name' => $this->name,'country_id'=>$this->country_id]);
        }
        $CC->save();
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('category_book_refresh');
        $this->reset('name');

    }
    public function render()
    {

        $country = Country::get();
        return view('dashboard.books.category.new-category',compact('country'));
    }
}
