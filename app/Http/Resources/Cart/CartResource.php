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
        if (Auth::guard('student')->check()) {


            $wallet        = Auth::guard('student')->user()->wallet;
            $subtotal      = $this->cart_details->sum('subtotal') ?? '0.00';
            $discount      = $this->cart_details->sum('discount') ?? '0.00';
            $total         = $this->cart_details->sum('total') ?? '0.00';

            switch (true) {
                case $total > $wallet:
                    $pay =   ($total - $wallet);
                    break;
                case $total <= $wallet:
                    $pay = '0';
                    break;
                default:
                    break;
            }
            return [
                'cart_id'         => $this->id ?? '',
                'coupon_id'       => $this->coupon_id ?? '',
                'discount_coupon' => $this->coupon ? $this->coupon->discount . '% Courses Only' : '0.00',
                'coupon_name'     => $this->coupon->name ?? '',
                'subtotal'        => number_format($subtotal, 2) ?? '0.00',
                'discount'        => number_format($discount, 2) ?? '0.00',
                'total'           => number_format($total, 2) ?? '0.00',
                'user_blance'     => number_format($wallet, 2)  ?? '0.00',
                'pay'             => number_format($pay, 2) ?? '0.00',
                'remaining_amount_of_balance'  => $pay == '0' ? number_format(($wallet - $total), 2) : '0.00',
                'cart_details'  =>$this->cart_details ? CartDetailsResource::collection($this->cart_details):[],
            ];
        } else {

            return [];
        }
    }
}
