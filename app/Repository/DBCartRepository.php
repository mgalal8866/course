<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Courses;
use App\Models\deferred;
use App\Models\StoreBook;
use App\Models\UserCoupon;
use App\Models\CartDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\CartRepositoryinterface;
use App\Repository\DBCouponRepository;

class DBCartRepository implements CartRepositoryinterface
{
    protected  $model;
    protected  $cart_details;
    protected  $request;
    protected  $couporeposirty;
    public function __construct(Cart $model, CartDetails $cart_details, Request $request, DBCouponRepository $couporeposirty)
    {
        $this->cart_details = $cart_details;
        $this->model = $model;
        $this->request = $request;
        $this->couporeposirty = $couporeposirty;
    }
    public function getcart()
    {
        $cart = $this->model->where('user_id', Auth::guard('student')->user()->id)->with(['cart_details' => function ($q) {
            $q->with(['book' => function ($qq) {
                $qq->select('book_name', 'qty_max', 'image', 'id', 'price');
            }, 'course' => function ($qq) {
                $qq->select('name', 'id', 'image', 'price');
            }]);
        }, 'coupon'])->first();

        return $cart;
    }
    public function addtocart()
    {
        $is_book = $this->request->input('is_book', 1);
        $product_id = $this->request->input('product_id', 1);
        $qty = $this->request->input('qty', 1);

        if ($is_book == 1) {
            $storebook =  StoreBook::find($product_id);
            if (!$storebook) {
                return null;
            } else {
                $price =  $storebook->price;
            }
        } else {
            $courses =  Courses::find($product_id);
            if (!$courses) {
                return null;
            } else {
                $price =  $courses->price;
            }
        }
        $w =   $this->model->updateOrCreate(
            [
                'user_id' => Auth::guard('student')->user()->id
            ],
            [
                'user_id' => Auth::guard('student')->user()->id,
            ]
        );
        // dd( number_format($qty * $price),2);

        $coupon = UserCoupon::find($w->coupon_id);
        if ($coupon && $is_book == 0) {
            $disc = ($coupon->discount / 100);
        } else {
            $disc = 0;
        }
        $this->cart_details->updateOrCreate(
            [
                'product_id' => $product_id ?? null,
                'cart_header' => $w->id ?? null,
            ],
            [
                'cart_header' => $w->id ?? null,
                'product_id' => $product_id,
                'coupon_id' => $w->coupon_id ?? null,
                'is_book'   => $is_book ?? null,
                'qty'       => $qty,
                'price'     => $price,
                'subtotal'  => ($qty * $price),
                'discount'  => ($w->coupon_id != null) ? DB::raw('subtotal * ' . $disc) : 0,
                'total'     => DB::raw('subtotal - discount'),
                // 'subtotal'  =>$qty * $price),2),
            ]
        );
        if ($qty == 0) {
            $this->deletecart($w->id);
        }
        if ($w) {
            return $this->getcart();
        }
    }
    public function deletecart()
    {
        $product_id = $this->request->input('product_id', 1);
        $w = $this->model->where('user_id', Auth::guard('student')->user()->id)->withCount('cart_details')->first('id');
        if ($w !== null) {

            $cart_details = $this->cart_details->where(['cart_header' => $w->id, 'product_id' => $product_id])->first();
            if ($cart_details !== null) {
                $cart_details->delete();
            }
            if ($this->cart_details->where(['cart_header' => $w->cart_header, 'is_book' => '0'])->count() < 1) {
                $w->update(['coupon_id' => null]);
            }
            if ($w->cart_details_count == 1) {
                $w->delete();
                return false;
            }
            return true;
        } else {
            // dd($w);
            return false;
        }
    }
}
