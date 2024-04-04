<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\CouponResource;
use App\Repositoryinterface\CouponRepositoryinterface;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Coupons;

class CouponController extends Controller
{
    private $couponRepositry;
    public function __construct(CouponRepositoryinterface $couponRepositry)
    {
        $this->couponRepositry = $couponRepositry;
    }

    public function checkcoupon()
    {
        $check = $this->couponRepositry->checkcoupon();
        if($check != null){

            return Resp(CartResource::collection($check), 'success', 200, true);
        }else{
            return Resp('', 'هذا الكوبون غير صالح', 400, true);
        }
    }


}
