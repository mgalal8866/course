<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection1Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

                'statu'     => $this['setting']['section1_statu']??'',
                'title'     => $this['setting']['section1_title']??'',
                'sub_title' => $this['setting']['section1_sub_title']??'',
                'body'      => $this['setting']['section1_body']??'',
                'slider'    => $this['slider']??'',


        ];
    }
}
