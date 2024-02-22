<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\deferred;
use App\Models\StoreBook;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\CartRepositoryinterface;

class DBCartRepository implements CartRepositoryinterface
{
    public function getcart()
    {
        return  Cart::where('user_id', Auth::guard('student')->user()->id)->with('book')->get();
    }
    public function addtocart($book_id, $qty)
    {
        $w =   Cart::updateOrCreate(['book_id' => $book_id, 'user_id' => Auth::guard('student')->user()->id], ['user_id' => Auth::guard('student')->user()->id, 'book_id' => $book_id, 'qty' => $qty]);
        if ($qty == 0) {
            $this->deletecart($w->id);
        }
        if ($w) {
            return $this->getcart();
        }
    }
    public function deletecart($book_id)
    {
        $w =   Cart::where('book_id', $book_id)->where('user_id', Auth::guard('student')->user()->id)->first();
        if ($w != null) {
            $w->delete();
            return   $this->getcart();
        } else {
            return   $this->getcart();
        };
    }

}
