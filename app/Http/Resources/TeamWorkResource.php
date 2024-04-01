<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamWorkResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name'         => ($this->first_name??'') . ' ' . ($this->middle_name??'') . ' ' . ($this->last_name??'') ,
            'image'        => $this->imageurl??''  ,
            'description'  => $this->description??''  ,
            'specialist'   => $this->specialist ??'',
            'facebook'     => $this->facebook??''  ,
            'x'            => $this->x??'' ,
            'linkedin'     =>  $this->linkedin ??'' ,
            'telegram'     => $this->telegram??''  ,


        ];
    }
}
