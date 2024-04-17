<?php

namespace App\Livewire\Dashboard\Order;

use App\Models\Orders;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class DetailsOrder extends Component
{
    public $order;
    public function mount($id =null)
    {
        if($id ==null){
           return  redirect()->route('order');

        }else{
           $this->order=  Orders::with(['order_details','transaction','coupon','user','order_details.course','order_details.book'])->find($id);
        }

    }

    public function render()
    {
        return view('dashboard.order.details-order');
    }
}
