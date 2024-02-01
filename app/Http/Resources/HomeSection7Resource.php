<?php

namespace App\Http\Resources;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection7Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'        => $this['setting']['section7_status']??'',
            'title'         => $this['setting']['section7_title']??'',
            'sub_title'     => $this['setting']['section7_sub_title']??'',
            'fqa'  => FqaResource::collection($this['fqa'])
        ];
    }
}
