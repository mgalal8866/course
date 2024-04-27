<?php

namespace App\Repository;

use App\Models\Cart;
use App\Models\UserCoupon;
use App\Models\CartDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\CartRepositoryinterface;
use App\Repositoryinterface\CouponRepositoryinterface;

class DBCouponRepository implements CouponRepositoryinterface
{
    protected  $cart;
    protected  $cart_details;
    protected  $model;
    protected  $request;
    public function __construct(UserCoupon $model, Cart $cart, CartDetails $cart_details,  Request $request)
    {
        $this->cart = $cart;
        $this->cart_details = $cart_details;
        $this->model = $model;
        $this->request = $request;
    }
    public function checkcoupon($coupon =null)
    {
        $coupon = $this->request->input('coupon', $coupon);
        $co = $this->model->where('name', $coupon)->first();
        if ($co) {
            try {
                $perco =  ($co->discount / 100);
                $cart = $this->cart->where('user_id', Auth::guard('student')->user()->id)->first();
                $cart->coupon_id = $co->id;
                $cart->save();
                $this->cart_details->where(['cart_header' => $cart->id, 'is_book' => '0'])->update([
                    'coupon_id' => $co->id,
                    'discount' => DB::raw('subtotal * ' . $perco),
                    'total' => DB::raw('subtotal - discount'),
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
             $this->cart->where('user_id', Auth::guard('student')->user()->id)->with(['cart_details'=>function($q){
                $q->with(['book' => function ($qq) {
                    $qq->select('book_name', 'image', 'id', 'price');
                }, 'course' => function ($qq) {
                    $qq->select('name', 'id', 'image', 'price');
                }]);
            },'coupon'])->first();
            // return  $this->cart_details->where('cart_header', $cart->id)->with(['book' => function ($q) {
            //     $q->select('book_name', 'image', 'id', 'price');
            // }, 'course' => function ($q) {
            //     $q->select('name', 'id', 'image', 'price');
            // }])->get();
            return true;
        } else {
            return false;
        }
    }
}
