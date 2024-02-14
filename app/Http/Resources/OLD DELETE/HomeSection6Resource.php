<?php

namespace App\Http\Resources;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection6Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'        => $this['setting']['section6_status']??'',
            'title'         => $this['setting']['section6_title']??'',
            'sub_title'     => $this['setting']['section6_sub_title']??'',
            'blog'  => BlogResource::collection($this['blog'])
        ];
    }
}
