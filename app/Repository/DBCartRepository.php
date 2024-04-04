<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Courses;
use App\Models\deferred;
use App\Models\StoreBook;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\CartRepositoryinterface;
use Illuminate\Http\Request;

class DBCartRepository implements CartRepositoryinterface
{
    protected  $model;
    protected  $cart_details;
    protected  $request;
    public function __construct(Cart $model, CartDetails $cart_details, Request $request)
    {
        $this->cart_details = $cart_details;
        $this->model = $model;
        $this->request = $request;
    }
    public function getcart()
    {
        // return
        $cart = $this->model->where('user_id', Auth::guard('student')->user()->id)->first('id');
        return $this->cart_details->where('cart_header', $cart->id)->with(
            ['book' => function ($q) {
                $q->select('book_name', 'image', 'id', 'price');
            }, 'course' => function ($q) {
                $q->select('name', 'id', 'image', 'price');
            }]
        )->get();


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
        $this->cart_details->updateOrCreate(
            [
                'product_id' => $product_id ?? null,
                'cart_header' => $w->id ?? null,
            ],
            [
                'cart_header' => $w->id ?? null,
                'product_id' => $product_id,
                'is_book' => $is_book ?? null,
                'qty' => number_format($qty),
                'price' =>  number_format($price),
                'subtotal' =>   number_format($qty * $price),
                'total' =>  number_format($qty * $price),
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
        $w = $this->model->where('user_id', Auth::guard('student')->user()->id)->first('id');

        if ($w !== null) {
            $cart_details = $this->cart_details->where(['cart_header' => $w->id, 'product_id' => $product_id])->first();

            if ($cart_details !== null) {
                $cart_details->delete();
            }

            return $this->getcart();
        } else {
            return $this->getcart();
        }
    }
}
