<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'     => $this->id,
            'name'   => $this->book_name,
            'image'   => $this->imageurl,
            'price'   => $this->price,
            'qty_max'   => $this->qty_max
        ];
    }
}
