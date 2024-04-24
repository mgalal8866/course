<?php

namespace App\Livewire\Dashboard\Order;

use App\Models\Orders;
use Livewire\Component;

class ViewOrders extends Component
{
    public function render()
    {
        $orders = Orders::with(['user','transaction','coupon'])->latest()->get();
        return view('dashboard.order.view-orders',compact('orders'));
    }
}
