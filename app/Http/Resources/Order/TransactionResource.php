<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'transaction_id' => $this->id??'',
            'payment_id' => $this->payment_id??'',
            'statu' => $this->statu??'',
        ];
    }
}
