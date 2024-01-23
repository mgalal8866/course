<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection3Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

                'status'     => $this['setting']['section3_status']??'',
                'title'     => $this['setting']['section3_title']??'',
                'category'  => $this['category'],


        ];
    }
}
