<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiBlogResource;
use App\Http\Resources\Order\OrderResource;
use App\Repositoryinterface\BlogRepositoryinterface;
use App\Repositoryinterface\OrderRepositoryinterface;

class OrderController extends Controller
{
    private $orderRepositry;
    public function __construct(OrderRepositoryinterface $orderRepositry)
    {
        $this->orderRepositry = $orderRepositry;
    }


    public function please_order()
    {
        $please_order = $this->orderRepositry->please_order();
        if( $please_order != null && $please_order == true){
          return Resp('', 'success', 200, true);
        }else{
          return Resp('','error','404');
        }
    }
    public function get_myorders()
    {
        $please_order = $this->orderRepositry->myorder();
        if( $please_order != null){
          return Resp(OrderResource::collection($please_order), 'success', 200, true);
        }else{
          return Resp('','No Order','404');
        }
    }


}
