<?php

namespace App\Http\Resources;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection5Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'        => $this['setting']['section5_status']??'',
            'title'         => $this['setting']['section5_title']??'',
            'sub_title'     => $this['setting']['section5_sub_title']??'',
            'say_about_us'  => AboutUsResource::collection($this['aboutus'])
        ];
    }
}
