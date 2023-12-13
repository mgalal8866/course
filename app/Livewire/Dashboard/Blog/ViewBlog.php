<?php

namespace App\Livewire\Dashboard\Blog;

use App\Models\Blog;
use Livewire\Component;
use App\Models\Specialist;

class ViewBlog extends Component
{
    protected $listeners = ['blog_course_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = Blog::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = Blog::find($id);
        $CC->delete();

    }
    public function render()
    {

        $blog = Blog::latest()->get();
         return view('dashboard.blog.viewblog',compact('blog'));
    }
}
