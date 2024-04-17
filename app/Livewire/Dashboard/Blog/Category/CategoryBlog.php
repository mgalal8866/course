<?php

namespace App\Livewire\Dashboard\Blog\Category;

use App\Models\CategoryBlog as ModelsCategoryBlog;
use App\Models\CategoryBook;
use Livewire\Component;

class CategoryBlog extends Component
{
    protected $listeners = ['category_blog_refresh'=>'$refresh'];

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
        $CC = ModelsCategoryBlog::find($id);
        $CC->delete();

    }
    public function render()
    {
        $Category = ModelsCategoryBlog::latest()->get();
        return view('dashboard.blog.category.category-blog',compact('Category'));
    }
}
