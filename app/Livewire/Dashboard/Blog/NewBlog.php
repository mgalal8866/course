<?php

namespace App\Livewire\Dashboard\Blog;

use App\Models\Blog;
use App\Models\Country;
use Livewire\Component;
use App\Models\Specialist;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;
use DOMDocument;

class NewBlog extends Component
{
    use WithFileUploads, ImageProcessing;
    protected $listeners = ['edit' => 'edit'];
    public $imageold,$title, $active=1,$image, $article,$edit = false, $id, $header;
    protected $rules = [
        'title'       => 'required',
        'article'     => 'required',
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
            $this->imageold = $tra->imageurl;
            $this->active = $tra->active==1?true:false;
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


        $Blog = Blog::updateOrCreate(['id' => $this->id], [
            'title'  => $this->title,
            'article'=> '',
            'active' => $this->active??1,
        ]);
        if ($this->image) {
            
            $dataX =  $this->saveImageAndThumbnail($this->image, false, $Blog->id, 'blog');
            $Blog->image =  $dataX['image'];

        }

        // $dom = new DOMDocument();
        // $dom->loadHTML( $this->article,9);
        // $images = $dom->getElementsByTagName('img');
        // foreach($images as $key=>$img){
            // dd($img->getAttribute('src'));
            // $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            // $image_name = "/files/" .time().$key.'.png';
            // file_put_contents(public_path().$image_name,$data);
            // $img->removeAttribute('src');
            // $img->setAttribute('src', $image_name);
        // }
        // $Blog->article =    $dom->saveHTML();
        $Blog->article =    $this->article;
        $Blog->save();

        $this->dispatch('closemodel');
        $this->dispatch('blog_course_refresh');

    }
    public function render()
    {
        $spec  = Specialist::latest()->get();
        $countrylist  = Country::latest()->get();
        return view('dashboard.blog.new-blog', compact(['spec', 'countrylist']));
    }
}
