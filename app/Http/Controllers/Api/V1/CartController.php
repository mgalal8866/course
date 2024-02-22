<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Repositoryinterface\CartRepositoryinterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepositry;
    public function __construct(CartRepositoryinterface $cartRepositry)
    {
        $this->cartRepositry = $cartRepositry;
    }

    public function getcart()
    {
        return Resp(CartResource::collection($this->cartRepositry->getcart()), 'success', 200, true);
    }
    public function deletefromcart(Request $request)
    {
        if($request->has('cart_id'))
        return Resp(CartResource::collection($this->cartRepositry->deletecart($request->cart_id)), 'success', 200, true);
    }
    public function addtocart(Request $request)
    {
        if($request->has('book_id') && $request->has('qty'))
        return Resp(CartResource::collection($this->cartRepositry->addtocart($request->book_id, $request->qty)), 'success', 200, true);
    }

}
