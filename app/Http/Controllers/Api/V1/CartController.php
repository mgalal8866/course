<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource as CartCartResource;
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
        if( $this->cartRepositry->getcart()){
            return Resp(new CartCartResource($this->cartRepositry->getcart()), 'success', 200, true);
          }else{
            return Resp([],'Not Cart ');
          }
    }
    public function deletefromcart()
    {
        if( $this->cartRepositry->deletecart()){
            return Resp(new CartCartResource($this->cartRepositry->getcart()), 'success', 200, true);
          }else{
            return Resp([],'succss');
          }
    }
    public function addtocart()
    {
        $add_cart= $this->cartRepositry->addtocart();
        if( $add_cart != null){
            return Resp(new CartCartResource( $add_cart), 'success', 200, true);
          }else{
            return Resp([],'Not found ');
          }
    }

}
