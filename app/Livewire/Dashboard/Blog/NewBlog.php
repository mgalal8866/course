<?php

namespace App\Livewire\Dashboard\Blog;

use App\Models\Country;
use App\Models\Blog;
use Livewire\Component;
use App\Models\Specialist;

class NewBlog extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $phone, $active,$mail, $balance, $country, $gender, $specialist, $name, $edit = false, $id, $header;
    protected $rules = [
        'name'       => 'required',
        'phone'      => 'required',
        'mail'       => 'required|email',
        'balance'    => 'required',
        'country'    => 'required',
        'gender'     => 'required',
        'specialist' => 'required',
    ];

    public function edit($id = null)
    {
        $this->edit = false;
        if ($id != null) {
            $tra = Blog::find($id);
            $this->id = $tra->id;
            $this->name = $tra->name;
            $this->phone = $tra->phone;
            $this->mail = $tra->email;
            $this->balance = $tra->balance;
            $this->country = $tra->country_id;
            $this->gender = $tra->gender;
            $this->specialist = $tra->specialist_id;
            $this->active = $tra->active==1?true:false;
            $this->edit = true;
            $this->header = __('tran.edit') . ' ' . __('tran.blog');
        } else {
            $this->name = null;
            $this->edit = false;
            $this->header =  __('tran.add') . ' ' . __('tran.blog');
        }
        $this->dispatch('openmodel');
    }

    public function save()
    {
        $this->validate();
        $CFC = Blog::updateOrCreate(['id' => $this->id], [
            'name'       => $this->name,
            'phone'      => $this->phone,
            'email'      => $this->mail,
            'balance'    => $this->balance,
            'country_id'    => $this->country,
            'gender'     => $this->gender,
            'specialist_id' => $this->specialist,
            'active' => $this->active,
        ]);
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
