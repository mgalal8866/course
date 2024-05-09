<?php

namespace App\Livewire\Dashboard\Order;

use App\Enum\PaymentStatus;
use App\Models\Orders;
use Livewire\Component;
use App\Models\OrdersDetails;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;

class DetailsOrder extends Component
{
    public $order,$status,$product_status;
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
       $this->dispatch('swal', type:'success',message: 'تم تغير حاله الطلب');


    }
    public function UpdatedProductStatus($val)
    {
        $val=    explode(',',$val);
       $orderdetails =  OrdersDetails::where(['id'=>$val[1]])->first();
        // dd( PaymentStatus::toarray($val[0]));
       $orderdetails->status = $val[0];
       $orderdetails->save();
       $this->dispatch('swal', type:'success',message: 'تم تغير حالة المنتج');



    }



    public function render()
    {
        return view('dashboard.order.details-order');
    }
}
