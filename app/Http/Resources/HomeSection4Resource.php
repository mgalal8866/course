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

                'status'     => $this['section4_status']??'',
                'title'     => $this['section4_title']??'',
                'body'     => $this['section4_body']??'',
                'image'     => path('','home') . $this['section4_image']??'',


        ];
    }
}
