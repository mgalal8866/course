<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailsOrderResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'cart_id' => $this->id ?? '',
            'product_id'    => $this->is_book ==1 ?$this->book->id :$this->course->id,
            'name'          => $this->is_book == 1 ?$this->book->book_name :$this->course->name ?? '',
            'image'         => $this->is_book == 1 ?$this->book->imageurl  :$this->course->imageurl ,
            'is_book'       => number_format($this->is_book) ?? '',
            'qty'           => $this->qty ?? '',
            'price'         => number_format(($this->is_book == 1 ?$this->book->price :$this->course->price) ,2)?? '',
            'subtotal'         => number_format($this->qty *  ($this->is_book == 1 ?$this->book->price :$this->course->price) ,2),
            'discount'      => $this->discount ?? '0',
            'total'      => number_format(($this->qty *  ($this->is_book == 1 ?$this->book->price :$this->course->price))-$this->discount ,2),
            // 'status'        => $this->status,
            'status'        => 'جارى المراجعه',
        ];
    }
}
