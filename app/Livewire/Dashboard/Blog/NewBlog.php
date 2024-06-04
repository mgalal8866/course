<?php

namespace App\Livewire\Dashboard\Blog;

use DOMDocument;
use App\Models\Blog;
use App\Models\Country;
use Livewire\Component;
use App\Models\Specialist;
use Illuminate\Support\Str;
use App\Models\CategoryBlog;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\File;

class NewBlog extends Component
{
    use WithFileUploads, ImageProcessing;
    protected $listeners = ['edit' => 'edit'];


    public $writer, $imageold, $title, $active = 1, $image, $article, $edit = false, $id, $header, $category_id, $country_id;
    protected $rules = [
        'title'       => 'required',
        'article'     => 'required',
        'writer'     => 'required',
        // 'image'       => 'required',
    ];

    public function edit($id = null)
    {

        $this->reset();
        if ($id != null) {

            $tra = Blog::find($id);
            $this->id = $tra->id;
            $this->title = $tra->title;
            $this->article = $tra->article;
            $this->writer = $tra->writer;
            $this->imageold = $tra->imageurl;
            $this->country_id = $tra->country_id;
            $this->category_id = $tra->category_id;

            $this->active = $tra->active == 1 ? true : false;
            $this->edit = true;
            $this->header = __('tran.edit') . ' ' . __('tran.blog');
        } else {
            $this->edit = false;
            $this->header =  __('tran.add') . ' ' . __('tran.blog');
        }
        $this->dispatch('openmodel');
    }

    public function save()
    {
        $this->validate();


        $blog = Blog::updateOrCreate(['id' => $this->id], [
            'title'  => $this->title,
            'category_id'  => $this->category_id,
            'country_id'  => $this->country_id,
            'writer'  => $this->writer,
            'article' => '',
            'views' => '0',
            'active' => $this->active ?? 1,
        ]);
        if ($this->image) {
            if ($blog->image != null) {
            }
            $dataX =  $this->saveImageAndThumbnail($this->image, false, $blog->id, 'blog');
            $blog->image =  $dataX['image'];
        }

        $blog->article =    $this->article;
        $blog->save();
        if ($this->id != null) {
            $this->dispatch('swal', message: 'تم التعديل بنجاح');
        } else {
            $this->dispatch('swal', message: 'تم الاضافه بنجاح');
        }

        $this->dispatch('closemodel');
        $this->dispatch('blog_course_refresh');
    }
    public function render()
    {
        $spec  = Specialist::latest()->get();
        $country  = Country::latest()->get();
        $categoryblog  = CategoryBlog::latest()->get();
        return view('dashboard.blog.new-blog', compact(['spec', 'country', 'categoryblog']));
    }
}
