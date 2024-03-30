<?php

namespace App\Http\Resources;

use App\Enum\TypeBook;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'        => $this->id,
            'name'      => $this->book_name??'',
            'image'     => $this->imageurl??'',
            'features'  => $this->features??'',
            'type'      => number_format($this->type) ??'',
            'link'      => $this->link ??'',
            'price'     => $this->price??'',
            'qty_max'   => $this->qty_max??'',
        ];
    }
}
