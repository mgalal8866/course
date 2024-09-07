<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Orders;
use App\Models\UserCoupon;
use App\Enum\PaymentStatus;

use Illuminate\Http\Request;
use App\Models\OrdersDetails;
use App\Traits\ImageProcessing;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Repositoryinterface\OrderRepositoryinterface;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Coupons;
use App\Repositoryinterface\CollectPointsRepositoryinterface;

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
    public function pay($payment_id, $carttotl, $invoice_number, $customer, $cartItems)
    {
        $cart = [];
        foreach ($cartItems as $item) {

            $cart[] = [
                'name'   => $item->is_book == 1 ? $item->book->book_name : $item->course->name ?? '',
                'price' => $item->total,
                'quantity' => $item->qty
            ];
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer d83a5d07aaeb8442dcbe259e6dae80a3f2e21a3a581e1a5acd',
        ])->post('https://staging.fawaterk.com/api/v2/invoiceInitPay', [
            'payment_method_id' => 2,
            'cartTotal' => $carttotl,
            'currency'  => 'EGP',
            'invoice_number' => $invoice_number,
            'customer' => [
                'first_name' => $customer['first_name'],
                'last_name'  => $customer['last_name'] ?? 'lastname',
                'email'      => $customer['email'] ?? $customer['first_name'] . '@meail.com',
                'phone'      => $customer['phone'],
                'address'    => 'no_address',
            ],
            'redirectionUrls' => [
                'successUrl' => 'http://localhost:4200/Cart/PaymentCallback?status=success',
                'failUrl' => 'http://localhost:4200/Cart/PaymentCallback?status=fail',
                'pendingUrl' => 'http://localhost:4200/Cart/PaymentCallback?status=pending',
            ],
            'cartItems' => $cart,
        ]);

        // To get the response body
        // $responseBody = $response->body();

        // To get the response data as an array (if the response is JSON)
        return Resp($response->json(), 'success', 200, true);


    }
    public function please_order()
    {

        try {
            DB::beginTransaction();

            $blance     = Auth::guard('student')->user()->wallet;
            $payment_id = $this->request->input('payment_id');
            $type       = $this->request->input('type');
            $image      = $this->request->file('image');
            $response   = $this->request->input('response');

            $cart = Cart::where('user_id', Auth::guard('student')->user()->id)->with(['cart_details' => function ($q) {
                $q->with(['book' => function ($qq) {
                    $qq->select('book_name', 'image', 'id', 'price');
                }, 'course' => function ($qq) {
                    $qq->select('name', 'id', 'image', 'price');
                }]);
            }, 'coupon'])->first();


            if ($payment_id == 0) {

                $user =   User::find(Auth::guard('student')->user()->id);
                $user->update(['wallet' => (Auth::guard('student')->user()->wallet - $cart->cart_details->sum('total'))]);

            }

            $order =  $this->order->create([
                'date'           => now(),
                'user_id'        => Auth::guard('student')->user()->id,
                'code'           => $cart->coupon_id ?? null,
                'transaction_id' => null,
                'subtotal'       => $cart->cart_details->sum('subtotal'),
                'discount'       => $cart->cart_details->sum('discount'),
                'total'          => $cart->cart_details->sum('total'),
            ]);


            foreach ($cart->cart_details as $item) {
                      $details = $this->detailsorder->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'is_book'    => $item->is_book,
                    'coupon_id'  => $item->coupon_id ?? null,
                    'qty'        => $item->qty      ?? '0.0',
                    'price'      => $item->price    ?? '0.0',
                    'subtotal'   => $item->subtotal ?? '0.0',
                    'discount'   => $item->discount ?? '0.0',
                    'total'      => $item->total    ?? '0.0',
                ]);
                if ($item->coupon_id != null) {

                    $this->collect->collect_points($item->coupon_id, $details->id);
                }
            }

            DB::commit();

            if ($type  == 1) {


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
                $cart =  Cart::whereUserId(Auth::guard('student')->user()->id)->first();
                $cart->cart_details()->delete();
                $cart->delete();

                return    Resp('جارى مراجعه الدفع', 'success', 200, true);
            } elseif ($type  == 2) {

                $rr = $this->pay($payment_id, $cart->cart_details->sum('total'), $order->id, Auth::guard('student')->user(), $cart->cart_details);
                $cart =  Cart::whereUserId(Auth::guard('student')->user()->id)->first();
                $cart->cart_details()->delete();
                $cart->delete();
                return $rr ;


            }




            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return  Resp( '', 'error ' . $e->getMessage() .$e->getLine() , 400, false);

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
        )->where('user_id', Auth::guard('student')->user()->id)->latest()->get();
    }
}
