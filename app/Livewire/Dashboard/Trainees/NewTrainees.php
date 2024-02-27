<?php

namespace App\Livewire\Dashboard\Trainees;

use App\Models\Country;
use App\Models\User;
use Livewire\Component;
use App\Models\Specialist;

class NewTrainees extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $phone, $wallet,$first_name, $last_name, $middle_name, $active, $mail, $balance, $country, $gender, $specialist, $name, $edit = false, $id, $header;
    protected $rules = [
        'name'       => 'required',
        'first_name'      => 'required',
        'middle_name'      => 'required',
        'last_name'      => 'required',
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
            $tra = User::find($id);
            $this->id = $tra->id;
            $this->middle_name = $tra->middle_name;
            $this->last_name = $tra->last_name;
            $this->first_name = $tra->first_name;
            $this->phone = $tra->phone;
            $this->mail = $tra->email;
            $this->balance = $tra->balance??'0.00';
            $this->wallet = $tra->wallet??'0.00';
            $this->country = $tra->country_id;
            $this->gender = $tra->gender;
            // $this->specialist = $tra->specialist_id;
            $this->active = $tra->active == 1 ? true : false;
            $this->edit = true;
            $this->header = __('tran.edit') . ' ' . __('tran.user');
        } else {
            $this->name = null;
            $this->edit = false;
            $this->header =  __('tran.add') . ' ' . __('tran.user');
        }
        $this->dispatch('openmodel');
    }

    public function save()
    {
        $this->validate();
        $CFC = User::updateOrCreate(['id' => $this->id], [
            'middle_name'=> $this->middle_name,
            'last_name'  => $this->last_name,
            'first_name' => $this->first_name,
            'phone'      => $this->phone,
            'email'      => $this->mail,
            'balance'    => $this->balance,
            'wallet'     => $this->wallet,
            'country_id' => $this->country,
            'gender'     => $this->gender,
            // 'specialist_id' => $this->specialist,
            'active' => $this->active,
        ]);
        $this->dispatch('closemodel');
        $this->dispatch('trainees_course_refresh');
    }
    public function render()
    {
        $spec  = Specialist::latest()->get();
        $countrylist  = Country::latest()->get();
        return view('dashboard.trainees.new-trainees', compact(['spec', 'countrylist']));
    }
}
