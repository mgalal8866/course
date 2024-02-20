<?php

namespace App\Livewire\Dashboard\Vimeo;
use Vimeo\Laravel\Facades\Vimeo;
use Livewire\Component;

class Filemanger extends Component
{
    public $data,$url;
    public function mount()
    {
        $dd =   Vimeo::request('/users/213717808/folders', null, 'GET');
        $this->data =  $dd['body']['data'];
    }
    public function xx($url)
    {
        $dd =   Vimeo::request($url, null, 'GET');
        $this->data =  $dd['body']['data'];
    }
    public function render()
    {

        return view('dashboard.vimeo.filemanger')->layout('layouts.dashboard.file-app');;
    }
}
