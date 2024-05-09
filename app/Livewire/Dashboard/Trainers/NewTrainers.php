<?php

namespace App\Livewire\Dashboard\Trainers;

use App\Models\User;
use App\Models\Country;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\Specialist;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;

class NewTrainers extends Component
{
    use WithFileUploads, ImageProcessing;
    protected $listeners = ['edit' => 'edit'];
    public $imagold, $image, $phone, $active, $mail, $balance, $country, $gender, $specialist, $fname, $mname, $lname, $edit = false, $id, $header;
    protected $rules = [
        'fname'       => 'required',
        'mname'       => 'required',
        'lname'       => 'required',
        'phone'      => 'required|unique:users,phone|digits_between:9,11',
        'mail'       => 'required|email',
        'balance'    => 'required|numeric',
        'country'    => 'required',
        'gender'     => 'required',
        'specialist' => 'required|exists:specialists,id',
    ];

    public function edit($id = null)
    {
        $this->edit = false;
        if ($id != null) {
            $tra = User::find($id);
            $this->id = $tra->id;
            $this->fname = $tra->first_name;
            $this->lname = $tra->last_name;
            $this->mname = $tra->middle_name;
            $this->phone = $tra->phone;
            $this->mail = $tra->email;
            $this->imagold = $tra->image;
            $this->balance = $tra->wallet;
            $this->country = $tra->country_id;
            $this->gender = $tra->gender;
            $this->specialist = $tra->specialist;
            $this->active = $tra->active == 1 ? true : false;
            $this->edit = true;
            $this->header = __('tran.edit') . ' ' . __('tran.trainer');
        } else {
            $this->reset();
            $this->id = null;
            $this->fname = null;
            $this->mname = null;
            $this->lname = null;
            $this->edit = false;
            $this->header =  __('tran.add') . ' ' . __('tran.trainer');
        }
        $this->dispatch('openmodel');
    }

    public function save()
    {

        DB::beginTransaction();
        $this->validate();
        try {
            $CFC = User::updateOrCreate(['id' => $this->id], [
                'first_name'       => $this->fname,
                'last_name'       => $this->lname,
                'middle_name'       => $this->mname,
                'phone'      => $this->phone,
                'email'      => $this->mail,
                'wallet'    => $this->balance,
                'password'    => '',
                'type'    => 1,
                'country_id'    => $this->country,
                'gender'     => $this->gender,
                'specialist' => $this->specialist,
                'active' => $this->active ?? 1,
            ]);
            if ($this->image != null) {
                $dataX = $this->saveImageAndThumbnail($this->image, false, null, null, 'trainer');
                $CFC->image =  $dataX['image'];
                $CFC->save();
            }
            DB::commit();
            $this->reset();
            $this->dispatch('closemodel');
            $this->dispatch('trainer_course_refresh');
            $this->reset();
        } catch (\Exception $e) {
            DB::rollback();
            $this->dispatch('swal', type:'error',message: $e->getMessage());

        }


    }
    public function render()
    {
        $spec  = Specialist::latest()->get();
        $countrylist  = Country::latest()->get();
        return view('dashboard.trainers.new-trainers', compact(['spec', 'countrylist']));
    }
}
