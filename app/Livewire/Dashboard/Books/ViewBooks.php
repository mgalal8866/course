<?php

namespace App\Livewire\Dashboard\Books;

use App\Models\StoreBook;
use Livewire\Component;

class ViewBooks extends Component
{
    protected $listeners = ['books_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = StoreBook::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = StoreBook::find($id);
        $CC->delete();

    }
    public function render()
    {
        $books = StoreBook::with(['category','category.country'])->latest()->get();
        return view('dashboard.books.view-books',compact('books'));
    }
}
