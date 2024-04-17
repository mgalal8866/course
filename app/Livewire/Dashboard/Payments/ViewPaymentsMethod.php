<?php

namespace App\Livewire\Dashboard\Payments;

use App\Models\PaymentMethods;
use Livewire\Component;


class ViewPaymentsMethod extends Component
{
    protected $listeners = ['paymentmethod_refresh'=>'$refresh'];

    public function activetoggle($id)
    {
        $CC = PaymentMethods::find($id);
        if($CC->active == 1){
            $CC->update(['active' => 0 ]);
        }
        else{
            $CC->update(['active'=>1]);
        }
    }
    public function delete($id)
    {
        $CC = PaymentMethods::find($id);
        $CC->delete();

    }
    public function render()
    {

        $paymentmethod = PaymentMethods::latest()->get();
         return view('dashboard.payment_method.payment_method',compact('paymentmethod'));
    }
}
