<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Http\Request;

use App\Models\OrdersDetails;
use App\Traits\ImageProcessing;
use App\Models\PaymentTransaction;
use App\Models\UserCoupon;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\OrderRepositoryinterface;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Coupons;

class DBOrderRepository implements OrderRepositoryinterface
{

    use  ImageProcessing;
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

        $blance     = Auth::guard('student')->user()->wallet;
        $payment_id = $this->request->input('payment_id');
        $type       = $this->request->input('type');
        $coupon_id  = $this->request->input('coupon_id');
        $image      = $this->request->input('image');
        $response   = $this->request->input('response');
        $cart = Cart::where('user_id', Auth::guard('student')->user()->id)->with(['book' => function ($q) {
            $q->select('book_name', 'id', 'price');
        }, 'course' => function ($q) {
            $q->select('name', 'id', 'price');
        }])->get();

        $tansaction =  PaymentTransaction::create(
            [
                'payment_id'    => $payment_id,
                'payment_type'  => $type,
                'price'         => $cart->sum('price'),
                'response'      => $response,
                'image'         => '',
                'statu'         => '',
            ]
        );
        if ($image) {
            $dataX = $this->saveImageAndThumbnail($image, false, $tansaction->id, 'transaction');
            $tansaction->image =  $dataX['image'];
            $tansaction->save();
        }

        $order =  $this->order->create([
            'date' => now(),
            'user_id' => Auth::guard('student')->user()->id,
            'code' => null,
            'transaction_id' => $tansaction->id,
            'subtotal' => $cart->sum('price'),
            'discount' => null,
            'total' => null,
        ]);
        $coupon = UserCoupon::find($coupon_id);
        foreach ($cart as $item) {
            $details = $this->detailsorder->create([
                'product_id' => $item->product_id,
                'is_book'    => $item->is_book,
                'coupon_id'  => $item->is_book == 0 ? $coupon_id ?? '' : '',
                'qty'        => number_format($item->qty),
                'price'      => number_format($item->price, 2),
                'subtotal'   => number_format($item->qty * $item->price, 2),
                'discount'   => $item->is_book == 0 ? (($coupon) ? ($item->price * ($coupon->discount / 100)) : '') : '0.0',
                'total'      => ($coupon) ? (($item->qty * $item->price) * ($coupon->discount / 100)) : number_format(($item->qty * $item->price), 2),
            ]);
        }
    }
}
