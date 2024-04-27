<?php

namespace App\Repository;

use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use App\Models\PointsTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CollectPointsRepositoryinterface;

class DBCollectPointsRepository implements CollectPointsRepositoryinterface
{
    protected Model $model;
    protected  $request;
    public function __construct(PointsTransaction $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function convert_points()
    {
        // 10 = 5
        $coupon  = UserCoupon::whereUserId(Auth::guard('student')->user()->id)->first();
        $user =  User::find(Auth::guard('student')->user()->id);
        $point =   $user->point;

        if ($point != 0) {
            $decimalNumber =  $point * $coupon->exchange_price;

            $user->update(['point' =>   0, 'wallet' => ($user->wallet +  $decimalNumber)]);
            $ww =  $this->model->create([
                'use_user_id' => Auth::guard('student')->user()->id,
                'collect_user_id' => null,
                'coupon_id' => $coupon->id,
                'type' => 1,
                'order_id' => null,
                'type' => '1',
                'point' => $coupon->point,
                'Cash' => $decimalNumber,
                'curenty' => 0,
                'remaining' => 0,
            ]);
        }
        return  $user;
    }

    public function collect_points($coupon_id, $order_id)
    {
        $coupon  = UserCoupon::with('user')->find($coupon_id);
        $ww =  $this->model->create([
            'use_user_id' => Auth::guard('student')->user()->id,
            'collect_user_id' => $coupon->user_id,
            'coupon_id' => $coupon->id,
            'type' => 1,
            'order_id' => $order_id,
            'type' => '1',
            'point' => $coupon->point,
            'Cash' => 0,
            'curenty' => 0,
            'remaining' => 0,
        ]);

        $user =  User::find($coupon->user_id);
        dd($user ,$coupon->collect_point_user);
        $user->increment('point', $coupon->collect_point_user);
    }
}
