<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorygradeResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'     => $this->id,
            'image'=> $this->name 
        ];
    }
}
