<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\TransactionResource;
use App\Http\Resources\Order\DetailsOrderResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date'     => $this->date,
            'subtotal' => $this->subtotal??'0.00',
            'discount' => $this->discount??'0.00',
            'total'    => $this->total??'0.00',
            'transaction' => new TransactionResource($this->transaction??[]),
            'order_details' => DetailsOrderResource::collection($this->order_details??[]),
        ];
    }
}
