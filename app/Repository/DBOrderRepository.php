<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Orders;
use Illuminate\Http\Request;

use App\Models\OrdersDetails;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\OrderRepositoryinterface;

class DBOrderRepository implements OrderRepositoryinterface
{
    protected  $order,$detailsorder;
    protected  $request;
    public function __construct(Orders $order,OrdersDetails $detailsorder, Request $request)
    {
        $this->order = $order;
        $this->detailsorder = $detailsorder;
        $this->request = $request;
    }
    public function please_order()
    {
        dd($this->request);
        return $this->order->create([]);
    }

}
