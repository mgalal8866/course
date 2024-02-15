<?php

namespace App\Livewire\Dashboard\Books;

use Livewire\Component;
use App\Models\StoreBook;
use App\Models\CategoryBook;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;

class NewBooks extends Component
{
    protected $listeners = ['edit' => 'edit'];
    public $edit = false, $id, $header,$image, $imagold,$book_name ,$category_id,$price,$qty_max;
    use WithFileUploads, ImageProcessing;
    public function edit($id = null)
    {
        if ($id != null) {

            $this->image = null;
            $CC = StoreBook::find($id);
            $this->book_name = $CC->book_name;
            $this->id = $id;
            $this->category_id =  $CC->category_id;
            $this->qty_max =  $CC->qty_max;
            $this->price =  $CC->price;
            $this->imagold = $CC->image !=null? $CC->imageurl:null;
            $this->edit = true;
            $this->header = __('tran.editbook');
        }else{
            $this->reset();
        //   $this->book_name =null;
        //   $this->imagold =null;
        //   $this->image =null;
        //   $this->edit = false;
          $this->header = __('tran.newbook');
        }
        $this->dispatch('openmodel');
    }
    protected $rules = [
        'book_name' => 'required',

    ];

    public function save()
    {

        $this->validate();
        if( $this->edit == true){
            $CC = StoreBook::find($this->id);
            $CC->book_name = $this->book_name;
            $CC->qty_max = $this->qty_max;
            $CC->price = $this->price;
            $CC->category_id = $this->category_id;


        }else{
            $CC = StoreBook::create([
                'book_name' => $this->book_name,
                'category_id'=>$this->category_id,
                'qty_max'=>$this->qty_max??'1',
                'price'=>$this->price,
            ]);

        }
        if ($this->image) {
            $dataX = $this->saveImageAndThumbnail($this->image, false,  null,null,'book');
            $CC->image =  $dataX['image'];
        }
        $CC->save();
        $this->edit = false;
        $this->dispatch('closemodel');
        $this->dispatch('books_refresh');
        $this->reset();

    }
    public function render()
    {
        $categorys  = CategoryBook::get();
        return view('dashboard.books.new-books',compact('categorys'));
    }
}
