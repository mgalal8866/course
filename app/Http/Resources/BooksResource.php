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
            'type'      => $this->type ==0 ?'كتاب مطبوع':'كتاب الكترونى (PDF)',
            // 'link'      => $this->link ??'',
            'link'      => $this->orderdetails != null ? ($this->type ==1 ? $this->link: '') :'',
            'currency'  => 'جنية مصرى',
            'price'     => $this->price??'',
            'qty_max'   => $this->qty_max??'',
        ];
    }
}
