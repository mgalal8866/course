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

                'status'     => $this['section2_status']??'',
                'title'     => $this['section2_title']??'',
                'body'      => $this['section2_body']??'',
                'image'     => path('','home') . $this['section2_image']??'',


        ];
    }
}
