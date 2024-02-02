<?php

namespace App\Http\Resources;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSection8Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'        => $this['setting']['section8_status'] ?? '',
            'title'         => $this['setting']['section8_title'] ?? '',
            'sub_title'     => $this['setting']['section8_sub_title'] ?? '',
            'image'     => path(null, 'home') . '8a64d8f58c69c40d93e2b4665b800795.jpg',
        ];
    }
}
