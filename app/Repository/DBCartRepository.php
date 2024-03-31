<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Cart;
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
    protected  $request;
    public function __construct(Cart $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
    public function getcart()
    {

        return $this->model->where('user_id', Auth::guard('student')->user()->id)->with(['book' => function ($q) {
            $q->select('book_name', 'id', 'price');
        }, 'course' => function ($q) {
            $q->select('name', 'id', 'price');
        }])->get();
    }
    public function addtocart()
    {
        $is_book = $this->request->input('is_book', 1);
        $product_id = $this->request->input('product_id', 1);
        $qty = $this->request->input('qty', 1);
        if($is_book==1){
           $storebook=  StoreBook::find( $product_id);
           if(!$storebook){
            return null;
           }
        }else{
            $courses=  Courses::find( $product_id);
            if(!$courses){
             return null;
            }
        }
        $w =   $this->model->updateOrCreate(
            [
                'product_id' => $product_id ?? null,
                'is_book' => $is_book ?? null,
                'user_id' => Auth::guard('student')->user()->id
            ],
            [
                'user_id' => Auth::guard('student')->user()->id,
                'product_id' => $product_id, 'is_book' => $is_book ?? null,
                'qty' => $qty
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
        $w =   $this->model->where(['product_id' => $product_id])->where('user_id', Auth::guard('student')->user()->id)->first();
        if ($w != null) {
            $w->delete();
            return   $this->getcart();
        } else {
            return   $this->getcart();
        };
    }
}
