<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Cart;
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

        // dd(  $this->model->whereHas('book')->orwhereHas('course')->where('user_id', Auth::guard('student')->user()->id)->with(['book', 'course'])->get());
        return  $this->model->whereHas('book')->orwhereHas('course')->where('user_id', Auth::guard('student')->user()->id)->with(['book', 'course'])->get();
    }
    public function addtocart()
    {
        $book_id = $this->request->input('book_id', 1);
        $course_id = $this->request->input('course_id', 1);
        $qty = $this->request->input('qty', 1);
        $w =   $this->model->updateOrCreate(['book_id' => $book_id ?? null, 'course_id' => $course_id ?? null, 'user_id' => Auth::guard('student')->user()->id], ['user_id' => Auth::guard('student')->user()->id, 'book_id' => $book_id, 'qty' => $qty]);
        if ($qty == 0) {
            $this->deletecart($w->id);
        }
        if ($w) {
            return $this->getcart();
        }
    }
    public function deletecart()
    {
        $book_id = $this->request->input('book_id', 1);
        $course_id = $this->request->input('course_id', 1);
        $w =   $this->model->where(['book_id' => $book_id, 'course_id' => $course_id])->where('user_id', Auth::guard('student')->user()->id)->first();
        if ($w != null) {
            $w->delete();
            return   $this->getcart();
        } else {
            return   $this->getcart();
        };
    }
}
