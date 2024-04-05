<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $wallet = Auth::guard('student')->user()->wallet;
        $subtotal      = number_format($this->cart_details->sum('subtotal'), 2) ?? '0.00';
        $discount      = number_format($this->cart_details->sum('discount'), 2) ?? '0.00';
        $total         = number_format($this->cart_details->sum('total'), 2) ?? '0.00';
 
        switch (true) {
            case $total > $wallet:
                $pay =   number_format($total-$wallet,2) ;
                break;
            case $total <= $wallet:
                $pay = '0.00';
                break;
            default:
                break;
        }
        return [
            'cart_id' => $this->id ?? '',
            'coupon_id'        => $this->coupon_id ?? '',
            'discount_coupon' => $this->coupon?$this->coupon->discount . '% Courses Only' :'0.00',
            'coupon_name' => $this->coupon->name??'',

            'subtotal'      => $subtotal ?? '0.00',
            'discount'      => $discount ?? '0.00',
            'total'         => $total ?? '0.00',
            'user_blance'   => $wallet  ?? '0.00',
            'pay'           => $pay ?? '0.00',
            'remaining_amount_of_balance'  => $pay =='0.00' ? number_format($wallet-$total,2): '0.00',
            'cart_details'  => CartDetailsResource::collection($this->cart_details??[]),
        ];
    }
}
