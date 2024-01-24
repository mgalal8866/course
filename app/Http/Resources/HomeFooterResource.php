<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeFooterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'phone'      => $this['phone']?? '',
            'address'    => $this['address']?? '',
            'mail'       => $this['mail']?? '',
            'facebook'   => $this['facebook']?? '',
            'instegram'  => $this['instegram']?? '',
            'telegram'   => $this['telegram']?? '',
            'linkedin'   => $this['linkedin']?? '',
            'youtube'    => $this['youtube']?? '',
            'description' => $this['description']?? '',
            'copyright'   => $this['copyright']?? '',

        ];
    }
}
