<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection2Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

                'statu'     => $this['section2_statu']??'',
                'title'     => $this['section2_title']??'',
                'body'      => $this['section2_body']??'',
                'image'     => $this['section2_image']??'',


        ];
    }
}
