<?php

namespace App\Repository;

use App\Models\Cart;
use Carbon\Carbon;
use App\Models\Orders;
use Illuminate\Http\Request;

use App\Models\OrdersDetails;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\OrderRepositoryinterface;

class DBOrderRepository implements OrderRepositoryinterface
{
    protected  $order, $detailsorder;
    protected  $request;
    public function __construct(Orders $order, OrdersDetails $detailsorder, Request $request)
    {
        $this->order = $order;
        $this->detailsorder = $detailsorder;
        $this->request = $request;
    }
    public function please_order()
    {
        $cart = Cart::where('user_id', Auth::guard('student')->user()->id)->with(['book' => function ($q) {
            $q->select('book_name', 'id', 'price');
        }, 'course' => function ($q) {
            $q->select('name', 'id', 'price');
        }])->get();

        $order =  $this->order->create([
            'date' =>now(),
            'user_id' => Auth::guard('student')->user()->id,
            'code' => null,
            'transaction_id' => null,
            'subtotal' => $cart->sum('price'),
            'discount' => null,
            'total' => null,
        ]);
        foreach ($cart as $item) {
            $details = $this->detailsorder->create([
                'product_id' => $item->product_id,
                'is_book'    => $item->is_book,
                'coupon_id'  => $item->is_book == 0 ? '' : '',
                'qty'        => number_format($item->qty),
                'price'      => number_format($item->price, 2),
                'subtotal'   => number_format($item->qty * $item->price, 2),
                'discount'   => null,
                'total'      => number_format($item->qty * $item->price, 2),
            ]);
        }

    }
}
