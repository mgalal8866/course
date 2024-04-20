<?php

namespace App\Livewire\Dashboard\Trainees;

use App\Models\Country;
use App\Models\User;
use Livewire\Component;
use App\Models\Specialist;
use App\Models\UserCoupon;

class NewTrainees extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public $coupon_active,$exchange_price,$exchange_point,$collect_point_user,$discount,$coupon;
    public $phone, $wallet, $first_name, $last_name, $middle_name, $active, $mail, $point, $country, $gender, $specialist, $name, $edit = false, $id, $header;
    protected $rules = [
        'first_name'      => 'required',
        'middle_name'      => 'required',
        'last_name'      => 'required',
        'mail'       => 'required|email',
        'country'    => 'required',
        'gender'     => 'required',

    ];

    public function edit($id = null)
    {
        $this->edit = false;
        if ($id != null) {
            $tra = User::with('user_coupon')->find($id);
            $this->id = $tra->id;
            $this->middle_name = $tra->middle_name;
            $this->last_name = $tra->last_name;
            $this->first_name = $tra->first_name;
            $this->phone = $tra->phone;
            $this->mail = $tra->email;
            $this->point = $tra->point ?? '0.00';
            $this->wallet = $tra->wallet ?? '0.00';
            $this->country = $tra->country_id;
            $this->gender = $tra->gender;

            if($tra->user_coupon){
                $this->coupon_active = $tra->user_coupon->active == 1?true:false;
                $this->collect_point_user = $tra->user_coupon->collect_point_user;
                $this->exchange_price = $tra->user_coupon->exchange_price;
                $this->discount = $tra->user_coupon->discount;
                $this->coupon = $tra->user_coupon->name;
            }
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
            'middle_name' => $this->middle_name,
            'last_name'  => $this->last_name,
            'first_name' => $this->first_name,
            'phone'      => $this->phone,
            'email'      => $this->mail,
            'point'      => $this->point,
            'wallet'     => $this->wallet,
            'country_id' => $this->country,
            'gender'     => $this->gender,
            'active'     => $this->active,
        ]);

        UserCoupon::updateOrCreate(['user_id'=>$CFC->id],[
            'active' =>  $this->coupon_active = 1 ?true:false ,
            'collect_point_user'=> $this->collect_point_user ,
            'exchange_price'=>$this->exchange_price ,
            'discount'=> $this->discount,
            'name'=>$this->coupon
        ]);




        // ['message' => 'تم التعديل بنجاح']
        $this->dispatch('swal', message: 'تم التعديل بنجاح' );
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
