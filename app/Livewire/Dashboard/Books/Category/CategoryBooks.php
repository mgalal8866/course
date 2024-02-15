<?php

namespace App\Livewire\Dashboard\Books\Category;

use App\Models\CategoryBook;
use Livewire\Component;

class CategoryBooks extends Component
{
    protected $listeners = ['category_book_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = CategoryBook::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = CategoryBook::find($id);
        $CC->delete();

    }
    public function render()
    {
        $Category = CategoryBook::latest()->get();
        return view('dashboard.books.category.category-books',compact('Category'));
    }
}
