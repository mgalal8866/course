<?php

namespace App\Repository;

use App\Enum\PaymentStatus;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\UserCoupon;

use Illuminate\Http\Request;
use App\Models\OrdersDetails;
use App\Traits\ImageProcessing;
use App\Models\PaymentTransaction;
use App\Repositoryinterface\CollectPointsRepositoryinterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\OrderRepositoryinterface;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Coupons;

class DBOrderRepository implements OrderRepositoryinterface
{

    use  ImageProcessing;
    protected  $order, $detailsorder, $collect;
    protected  $request;
    public function __construct(Orders $order, CollectPointsRepositoryinterface $collect, OrdersDetails $detailsorder, Request $request)
    {
        $this->collect = $collect;
        $this->order = $order;
        $this->detailsorder = $detailsorder;
        $this->request = $request;
    }
    public function please_order()
    {
        try {
            // DB::beginTransaction();
            $blance     = Auth::guard('student')->user()->wallet;
            $payment_id = $this->request->input('payment_id');
            $type       = $this->request->input('type');
            $image      = $this->request->input('image');
            $response   = $this->request->input('response');

            $cart = Cart::where('user_id', Auth::guard('student')->user()->id)->with(['cart_details' => function ($q) {
                $q->with(['book' => function ($qq) {
                    $qq->select('book_name', 'image', 'id', 'price');
                }, 'course' => function ($qq) {
                    $qq->select('name', 'id', 'image', 'price');
                }]);
            }, 'coupon'])->first();

            $tansaction =  PaymentTransaction::create(
                [
                    'payment_id'    => $payment_id,
                    'user_id'       => Auth::guard('student')->user()->id,
                    'payment_type'  => $type,
                    'price'         => $cart->cart_details->sum('total'),
                    'response'      => $response,
                    'image'         => null,
                    'statu'         => PaymentStatus::Pending,
                ]
            );


            if ($image) {
                $dataX = $this->saveImageAndThumbnail($image, false, $tansaction->id, 'transaction');
                $tansaction->image =  $dataX['image'];
                $tansaction->save();
            }
            $order =  $this->order->create([
                'date'           => now(),
                'user_id'        => Auth::guard('student')->user()->id,
                'code'           => $cart->coupon_id ?? null,
                'transaction_id' => $tansaction->id,
                'subtotal'       => $cart->cart_details->sum('subtotal'),
                'discount'       => $cart->cart_details->sum('discount'),
                'total'          => $cart->cart_details->sum('total'),
            ]);
            foreach ($cart->cart_details as $item) {
                $details = $this->detailsorder->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'is_book'    => $item->is_book,
                    'coupon_id'  => $item->coupon_id??null,
                    'qty'        => $item->qty      ?? '0.0',
                    'price'      => $item->price    ?? '0.0',
                    'subtotal'   => $item->subtotal ?? '0.0',
                    'discount'   => $item->discount ?? '0.0',
                    'total'      => $item->total    ?? '0.0',
                ]);
                if ($item->coupon_id != null) {

                    $this->collect->collect_points($item->coupon_id,$details->id);
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            $qq = $e->getMessage();
            DB::rollback();
            dd( $qq);
            return $qq;
        }
    }

    public function myorder()
    {
        return $dd =   Orders::with(
            [
                'transaction',
                'order_details',
                'order_details.book',
                'order_details.course'
            ]
        )->where('user_id', Auth::guard('student')->user()->id)->get();
    }
}
