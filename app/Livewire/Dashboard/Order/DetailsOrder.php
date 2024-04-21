<?php

namespace App\Livewire\Dashboard\Order;

use App\Models\Orders;
use App\Models\PaymentTransaction;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class DetailsOrder extends Component
{
    public $order,$status;
    public function mount($id =null)
    {
        if($id ==null){
           return  redirect()->route('order');

        }else{
           $this->order=  Orders::with(['order_details','transaction','coupon','user','order_details.course','order_details.book'])->find($id);
           $this->status =$this->order->transaction->statu;
        }

    }
    public function UpdatedStatus($val)
    {
       $s =  PaymentTransaction::find($this->order->transaction_id);
       $s->statu =$val;
       $s->save();

    }
    public function invod_status($val,$id)
    {
    dd($val,$id);

    }

    public function render()
    {
        return view('dashboard.order.details-order');
    }
}
