<?php

namespace App\Http\Resources;

use App\Models\AboutUs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        return [
            'cart_id' => $this->id??'',
            'book_id'    => $this->book->id??'',
            'book_name'  => $this->book->name??'',
            'book_qty'   => $this->qty??'',
            'price'      => $this->price??'',
            'discount'   => $this->discount??'',
            'subtotal'   => $this->subtotal??'',
            'total'      => $this->total??'',
        ];
    }
}
