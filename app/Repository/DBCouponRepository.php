<?php

namespace App\Repository;

use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositoryinterface\CartRepositoryinterface;
use App\Repositoryinterface\CouponRepositoryinterface;

class DBCouponRepository implements CouponRepositoryinterface
{
    protected  $model;
    protected  $request;
    public function __construct(UserCoupon $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
    public function checkcoupon()
    {
        $coupon = $this->request->input('coupon', 1);
     
        return $this->model->where('name', $coupon)->first();
    }

}
