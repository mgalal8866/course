<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection4Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

                'statu'     => $this['setting']['section4_statu']??'',
                'title'     => $this['setting']['section4_title']??'',
                'body'     => $this['setting']['section4_body']??'',
                'image'     => $this['setting']['section4_image']??'',


        ];
    }
}
