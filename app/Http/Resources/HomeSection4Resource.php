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

                'statu'     => $this['section4_statu']??'',
                'title'     => $this['section4_title']??'',
                'body'     => $this['section4_body']??'',
                'image'     => $this['section4_image']??'',


        ];
    }
}
