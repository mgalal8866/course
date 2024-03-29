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
    public function deletefromcart()
    {
        return Resp(CartResource::collection($this->cartRepositry->deletecart()), 'success', 200, true);
    }
    public function addtocart()
    {
        return Resp(CartResource::collection($this->cartRepositry->addtocart()), 'success', 200, true);
    }

}
